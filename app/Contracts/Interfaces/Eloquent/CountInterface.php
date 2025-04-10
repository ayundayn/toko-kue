<?php

namespace App\Contracts\Interfaces\Eloquent;

interface CountInterface
{
    public function count(?array $data): int;
}