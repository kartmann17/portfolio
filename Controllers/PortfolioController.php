<?php

namespace App\Controllers;

class PortfolioController extends Controller{

    public function index()
    {
        $title = "Nos réalisation";
        $this->render('portfolio/index',[
            'title' => $title
        ]);
    }

}