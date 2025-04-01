<?php

namespace App\Controllers;

class ConditionTarifaireController extends Controller {

    public function index()
    {
        $title = "Conditions d'utilisation";
        $this->render('ConditionTarifaire/index',[
            'title' => $title
        ]);
    }
}