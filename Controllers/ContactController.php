<?php

namespace App\Controllers;

class ContactController extends Controller
{
    public function index()
    {
        $title = "Contactez-nous";
        $this->render('contact/index',[
            'title' => $title
        ]);
    }
}