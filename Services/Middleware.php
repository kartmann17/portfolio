<?php

namespace App\Services;

class Middleware
{
    /**
     * Vérifie si l'utilisateur est authentifié
     * Redirige vers la page de connexion si ce n'est pas le cas
     *
     * @return void
     */
    public static function requireAuth()
    {
        // Vérifier si la session est valide
        if (!SessionManager::isSessionValid()) {
            header('Location: /log');
            exit();
        }

        // Vérifier si l'utilisateur est connecté
        if (!SessionManager::isLoggedIn()) {
            header('Location: /log');
            exit();
        }
    }

    /**
     * Vérifie si l'utilisateur a le rôle admin
     * Redirige vers la page d'accueil si ce n'est pas le cas
     *
     * @return void
     */
    public static function requireAdmin()
    {
        // D'abord vérifier que l'utilisateur est connecté
        self::requireAuth();

        // Ensuite vérifier qu'il a le rôle admin
        if (!SessionManager::hasRole('Admin')) {
            header('Location: /');
            exit();
        }
    }

    /**
     * Vérifie si la requête est sécurisée (HTTPS)
     * Redirige vers HTTPS si ce n'est pas le cas
     *
     * @return void
     */
    public static function requireSecureConnection()
    {
        if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
            $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header('Location: ' . $redirect);
            exit();
        }
    }

    /**
     * Limite le taux de requêtes pour prévenir les attaques par force brute
     *
     * @param string $key Identifiant unique pour limiter (ex: IP ou email)
     * @param int $maxRequests Nombre maximum de requêtes autorisées
     * @param int $timeWindow Fenêtre de temps en secondes
     * @return bool True si la requête est autorisée, sinon exit()
     */
    public static function rateLimit($key, $maxRequests = 5, $timeWindow = 60)
    {
        $cacheKey = "rate_limit_" . md5($key);

        if (isset($_SESSION[$cacheKey])) {
            $rateData = $_SESSION[$cacheKey];

            // Nettoyer les anciennes entrées
            $currentTime = time();
            $rateData['requests'] = array_filter($rateData['requests'], function ($timestamp) use ($currentTime, $timeWindow) {
                return ($currentTime - $timestamp) < $timeWindow;
            });

            // Vérifier si le nombre de requêtes dépasse la limite
            if (count($rateData['requests']) >= $maxRequests) {
                http_response_code(429);
                echo json_encode([
                    "status" => "error",
                    "message" => "Trop de requêtes. Veuillez réessayer dans quelques minutes."
                ]);
                exit();
            }

            // Ajouter la requête actuelle
            $rateData['requests'][] = $currentTime;
            $_SESSION[$cacheKey] = $rateData;
        } else {
            // Première requête pour cette clé
            $_SESSION[$cacheKey] = [
                'requests' => [time()]
            ];
        }

        return true;
    }
}
