<?php

namespace App\Controllers;

use App\Repository\SendEmailRepository;

Class SendEmailController extends Controller{

    public function EmailClient(){

        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){

            $data = $_POST;
            $sendEmailRepository = new SendEmailRepository();
            $sendEmailRepository->create($data);


        }
    }

}