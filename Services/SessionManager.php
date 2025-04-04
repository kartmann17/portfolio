<?php

namespace App\Services;

class SessionManager
{
    /**
     * Initialisation sécurisée de la session
     *
     * Démarre la session avec des paramètres de sécurité renforcés
     * et vide le tampon de sortie pour éviter les en-têtes envoyés par erreur
     *
     * @return void
     */
    public static function init()
    {
        // Configuration des cookies de session sécurisés
        ini_set('session.cookie_httponly', 1); // Empêche l'accès JavaScript au cookie de session
        ini_set('session.use_only_cookies', 1); // Force l'utilisation des cookies pour la session
        ini_set('session.cookie_secure', 1); // Cookies uniquement via HTTPS
        ini_set('session.cookie_samesite', 'Strict'); // Empêche les requêtes cross-site
        ini_set('session.gc_maxlifetime', 3600); // Session expirée après 1 heure d'inactivité

        // Définir un nom de session personnalisé pour éviter les attaques par défaut
        session_name('KREYATIKSESSID');

        // Démarrer la session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Vérifier si la session doit être régénérée (toutes les 15 minutes)
        if (
            !isset($_SESSION['last_regeneration']) ||
            (time() - $_SESSION['last_regeneration']) > 900
        ) {
            self::regenerateSession();
        }

        // Générer le token CSRF si nécessaire
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Définir l'horodatage de dernière activité
        $_SESSION['last_activity'] = time();
    }

    /**
     * Régénère l'ID de session et met à jour l'horodatage de régénération
     *
     * @return void
     */
    public static function regenerateSession()
    {
        // Régénérer l'ID de session
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();

        // Stocke l'adresse IP et l'agent utilisateur pour détecter les détournements de session
        $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
    }

    /**
     * Vérifie si la session est valide (n'a pas expiré et n'a pas été détournée)
     *
     * @return bool Retourne vrai si la session est valide, faux sinon
     */
    public static function isSessionValid()
    {
        // Vérifier la durée d'inactivité (30 minutes)
        if (
            isset($_SESSION['last_activity']) &&
            (time() - $_SESSION['last_activity'] > 1800)
        ) {
            self::destroy();
            return false;
        }

        // Vérifier si l'adresse IP a changé
        if (
            isset($_SESSION['ip_address']) &&
            $_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR']
        ) {
            self::destroy();
            return false;
        }

        // Vérifier si l'agent utilisateur a changé
        if (
            isset($_SESSION['user_agent']) &&
            $_SESSION['user_agent'] !== ($_SERVER['HTTP_USER_AGENT'] ?? '')
        ) {
            self::destroy();
            return false;
        }

        return true;
    }

    /**
     * Détruit la session en cours
     *
     * @return void
     */
    public static function destroy()
    {
        // Vider les données de session
        $_SESSION = [];

        // Détruire le cookie de session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Détruire la session
        session_destroy();
    }

    /**
     * Crée une session utilisateur après connexion réussie
     *
     * @param object $user L'objet utilisateur avec ses données
     * @return void
     */
    public static function createUserSession($user)
    {
        // Régénérer l'ID de session pour éviter la fixation de session
        self::regenerateSession();

        // Stocker les données utilisateur en session
        $_SESSION['id'] = $user->id;
        $_SESSION['name'] = $user->name;
        $_SESSION['email'] = $user->email;
        $_SESSION['role'] = $user->role;

        // Horodatage de connexion
        $_SESSION['login_time'] = time();
    }

    /**
     * Vérifie le jeton CSRF
     *
     * @param string $token Le jeton CSRF à valider
     * @return bool True si le jeton est valide, false sinon
     */
    public static function validateCsrfToken($token)
    {
        if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
            return false;
        }
        return true;
    }

    /**
     * Vérifie si l'utilisateur est connecté
     *
     * @return bool True si l'utilisateur est connecté, false sinon
     */
    public static function isLoggedIn()
    {
        return isset($_SESSION['id']);
    }

    /**
     * Vérifie si l'utilisateur a un rôle spécifique
     *
     * @param string $role Le rôle à vérifier
     * @return bool True si l'utilisateur a le rôle, false sinon
     */
    public static function hasRole($role)
    {
        return (isset($_SESSION['role']) && $_SESSION['role'] === $role);
    }
}
