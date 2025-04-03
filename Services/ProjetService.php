<?php

namespace App\Services;

use App\Repository\ProjetRepository;
use App\Models\ProjetModel;

class ProjetService
{

    public function createProject($data)
    {
        header('Content-Type: application/json');

        if (empty($data['name']) || empty($data['status'])) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => "Le nom et le statut sont obligatoires."
            ]);
            exit();
        }

        $data = [
            'name' => htmlspecialchars(trim($data['name'])),
            'status' => htmlspecialchars(trim($data['status']))
        ];

        $projetModel = new ProjetModel();
        $projetModel->hydrate($data);

        $projectId = (new ProjetRepository())->create($data);

        if ($projectId) {
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "message" => "Projet ajouté.",
                "id" => $projectId
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "status" => "error",
                "message" => "Erreur lors de l’ajout du projet."
            ]);
        }

        exit();
    }

    public function getAll()
{
    header('Content-Type: application/json');

    $repo = new ProjetRepository();
    $projects = $repo->findAll();

    echo json_encode($projects);
    exit();
}
}
