<?php

namespace App\Repository;

class UserRepository extends DBRepository
{
    public function __construct()
    {
        $this->table = 'User';
    }

    public function search($email)
    {
        return $this->req(
            "SELECT u.id, u.name, u.password, u.email, u.is_verified, u.id_role, r.role
             FROM " . $this->table . " u
             JOIN Role r ON u.id_role = r.id
             WHERE u.email = :email",
            ['email' => $email]
        )->fetch();
    }

    /**
     * Met à jour la date de dernière connexion d'un utilisateur
     *
     * @param int $userId L'identifiant de l'utilisateur
     * @return bool True si la mise à jour a réussi, false sinon
     */
    public function updateLastLogin($userId)
    {
        $currentTime = date('Y-m-d H:i:s');

        try {
            $this->req(
                "UPDATE " . $this->table . " SET last_login = :lastLogin WHERE id = :id",
                [
                    'lastLogin' => $currentTime,
                    'id' => $userId
                ]
            );
            return true;
        } catch (\Exception $e) {
            error_log("Erreur lors de la mise à jour de la dernière connexion: " . $e->getMessage());
            return false;
        }
    }
}
