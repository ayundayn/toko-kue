<?php

namespace App\Contracts\Interfaces\Eloquent;

interface InsertInterface
{
    public function insert(array $data): mixed;
}