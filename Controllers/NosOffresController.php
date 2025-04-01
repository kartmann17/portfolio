<?php

namespace App\Controllers;

class NosOffresController extends Controller
{
    public function index()
    {
        $title = "Nos Offres";
        $this->render('NosOffres/index',[
            'title' => $title
        ]);
    }
}