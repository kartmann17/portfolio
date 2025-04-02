<?php

namespace App\Controllers;

use App\Services\SendEmailService;

Class SendEmailController extends Controller{

    public function emailClient()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(["status" => "error", "message" => "Méthode de requête non autorisée."]);
            exit();
        } else {
            $data = $_POST;
            $sendEmailService = new SendEmailService();
            $sendEmailService->saveMessage($data);
        }
    }

}