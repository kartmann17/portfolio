<?php

namespace App\Controllers;

use App\Services\ProjetService;

class DashprojetController extends Controller
{

    public function ajoutProjet()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["status" => "error", "message" => "Méthode non autorisée."]);
            exit();
        }

        $data = $_POST;
        $service = new ProjetService();
        $service->createProject($data);
    }

    public function listeProjets()
    {
        return (new ProjetService())->getAll();
    }
}
