<?php

namespace App\Contracts\Repositories;

use App\Models\Pelanggan;
use App\Contracts\Interfaces\PelangganInterface;

class PelangganRepository extends BaseRepository implements PelangganInterface {

    public function __construct(Pelanggan $pelanggan) {
        $this->model = $pelanggan;
    }

    public function get(): mixed {
        return $this->model->query()->orderBy('id','DESC')->get();
    }

    public function show(mixed $id): mixed {
        return $this->model->query()->findOrFail($id);
    }

    public function store(array $data): mixed {
        return $this->model->query()->create($data);
    }

    public function update(mixed $id, array $data): mixed {
        return $this->model->query()->findOrFail($id)->update($data);
    }

    public function delete(mixed $id): mixed {
        return $this->model->query()->findOrFail($id)->delete();
    }
}