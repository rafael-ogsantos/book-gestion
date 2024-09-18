<?php

namespace app\modules\book\interfaces;

interface IBookService
{
    public function create($data);
    public function findAll();
}