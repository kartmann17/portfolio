<?php

namespace App\Repository;

class ProjetRepository extends DBRepository
{
    public function __construct()
    {
        $this->table = 'projects';
    }
}