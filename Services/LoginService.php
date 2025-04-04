<?php

namespace App\Services;

use App\Repository\UserRepository;

class LoginService
{
    public function login($data)
    {
        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $password = $data['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Email invalide."]);
            exit();
        }

        $userRepository = new UserRepository();
        $user = $userRepository->search($email);

        // Vérifier si l'utilisateur est confirmé
        if ($user && $user->is_verified == '0') {
            http_response_code(403);
            echo json_encode(["status" => "error", "message" => "Veuillez confirmer votre adresse email avant de vous connecter."]);
            exit();
        }

        if ($user && password_verify($password, $user->password)) {
            // Utiliser le SessionManager pour créer une session sécurisée
            SessionManager::createUserSession($user);

            // Mettre à jour la dernière connexion dans la base de données
            $userRepository->updateLastLogin($user->id);

            http_response_code(200);
            echo json_encode(["status" => "success", "redirect" => "/Dashboard/index"]);
        } else {
            // Log tentative de connexion échouée
            $this->logFailedLogin($email);

            http_response_code(401);
            echo json_encode(["status" => "error", "message" => "Email ou Mot de passe incorrect."]);
        }
        exit();
    }

    public function logout()
    {
        // Utiliser le SessionManager pour détruire la session
        SessionManager::destroy();

        http_response_code(200);
        echo json_encode(["status" => "success", "redirect" => "/"]);
        exit();
    }

    /**
     * Journalise les tentatives de connexion échouées
     *
     * @param string $email L'email utilisé pour la tentative de connexion
     * @return void
     */
    private function logFailedLogin($email)
    {
        // Dans un environnement de production, on pourrait enregistrer cela dans un fichier de log
        // ou une table de base de données pour suivre les tentatives d'intrusion
        error_log("Tentative de connexion échouée pour l'email: " . $email . " - IP: " . $_SERVER['REMOTE_ADDR']);
    }
}
