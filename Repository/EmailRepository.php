<?php

namespace App\Repository;

class EmailRepository extends DBRepository
{
    public function __construct()
    {
        $this->table = 'Mail';
    }
}
