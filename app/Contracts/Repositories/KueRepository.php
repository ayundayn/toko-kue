<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\KueInterface;
use App\Models\Kue;

class KueRepository extends BaseRepository implements KueInterface {

    public function __construct(Kue $kue) {
        $this->model = $kue;
    }

    public function get(): mixed {
        return $this->model->query()->with('kategori')->orderBy('id','DESC')->get();
    }

    public function show(mixed $id): mixed {
        return $this->model->query()->findOrFail($id);
    }

    public function store(array $data): mixed {
        return $this->model->create($data);
    }

    public function update(mixed $id, array $data): mixed {
        return $this->model->query()->findOrFail($id)->update($data);
    }

    public function delete(mixed $id): mixed {
        return $this->model->query()->findOrFail($id)->delete();
    }
}