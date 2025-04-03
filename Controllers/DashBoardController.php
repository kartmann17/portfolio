<?php

namespace App\Controllers;

use App\Services\TachesService;


class DashBoardController extends Controller
{

    public function index()
    {
        $this->render('Dashboard/index');
    }

    public function ajoutTache()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["status" => "error", "message" => "Méthode de requête non autorisée."]);
            exit();
        } else {
            $data = $_POST;
            $tachesService = new TachesService();
            $tachesService->createTask($data);
        }
    }

    public function updateTache()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["status" => "error", "message" => "Méthode de requête non autorisée."]);
            exit();
        }

        $data = $_POST;
        $tachesService = new TachesService();
        $tachesService->updateTask($data);
    }

    public function deleteTache()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["status" => "error", "message" => "Méthode de requête non autorisée."]);
            exit();
        }

        if (!isset($_POST['id'])) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID de la tâche requis."]);
            exit();
        }

        $tachesService = new TachesService();
        $tachesService->deleteTask((int) $_POST['id']);
    }

    public function listetaches()
    {
        $service = new TachesService();
        $service->getAll();
    }

}
