<?php

namespace App\Repository;

class TachesRepository extends DBRepository
{
    public function __construct()
    {
        $this->table = 'taches';
    }
}