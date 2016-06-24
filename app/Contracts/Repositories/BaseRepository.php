<?php

namespace App\Contracts\Repositories;

interface BaseRepository
{
    public function find($id);

    public function search($data);

    public function create($data);

    public function update($data);
}