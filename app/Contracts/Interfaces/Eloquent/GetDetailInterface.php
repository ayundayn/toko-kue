<?php
namespace App\Contracts\Interfaces\Eloquent;

interface GetDetailInterface
{
    public function getDetail($id): mixed;
}