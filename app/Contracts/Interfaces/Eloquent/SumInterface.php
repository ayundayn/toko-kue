<?php

namespace App\Contracts\Interfaces\Eloquent;

interface SumInterface 
{
    public function sum(?array $data): int;
}