<?php

namespace App\Contracts\Repositories;

use App\Models\Kategori;
use App\Contracts\Interfaces\KategoriInterface;

class KategoriRepository extends BaseRepository implements KategoriInterface {

    public function __construct(Kategori $kategori) {
        $this->model = $kategori;
    }

    public function get(): mixed {
        return $this->model->query()->orderBy('id','DESC')->get();
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