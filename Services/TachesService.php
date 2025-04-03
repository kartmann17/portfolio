<?php

namespace App\Services;

use App\Repository\TachesRepository;
use App\Models\TachesModel;

class TachesService
{

    public function createTask($data)
    {
        header('Content-Type: application/json');

        // Validation du titre
        if (empty($data['title'])) {
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => "Le nom de la tâche est requis."
            ]);
            exit();
        }

        // Préparation des données (sans project_id)
        $data = [
            'title' => htmlspecialchars(trim($data['title'])),
            'status' => 'todo'
        ];

        $TachesModel = new TachesModel();
        $TachesModel->hydrate($data);

        $repository = new TachesRepository();
        $taskId = $repository->create($data);

        if ($taskId) {
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "message" => "Tâche créée avec succès.",
                "id" => $taskId
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                "status" => "error",
                "message" => "Impossible de créer la tâche."
            ]);
        }

        exit();
    }

    public function updateTask($data)
    {
        header('Content-Type: application/json');

        if (empty($data['id']) || empty($data['status'])) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID et statut requis."]);
            exit();
        }

        $id = (int) $data['id'];
        $status = htmlspecialchars(trim($data['status']));

        $allowed = ['todo', 'inprogress', 'done'];
        if (!in_array($status, $allowed)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Statut invalide."]);
            exit();
        }

        $dataToUpdate = ['status' => $status];

        $result = (new TachesRepository())->update($id, $dataToUpdate);

        if ($result) {
            http_response_code(200);
            echo json_encode(["status" => "success", "message" => "Statut mis à jour."]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Erreur lors de la mise à jour."]);
        }

        exit();
    }

    public function deleteTask($id)
    {
        header('Content-Type: application/json');

        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID invalide."]);
            exit();
        }

        $result = (new TachesRepository())->delete((int)$id);

        if ($result) {
            http_response_code(200);
            echo json_encode(["status" => "success", "message" => "Tâche supprimée avec succès."]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Erreur lors de la suppression."]);
        }

        exit();
    }

    public function getAll()
    {
        header('Content-Type: application/json');

        $repo = new TachesRepository();
        $taches = $repo->findAll();

        echo json_encode($taches);
        exit();
    }
}
