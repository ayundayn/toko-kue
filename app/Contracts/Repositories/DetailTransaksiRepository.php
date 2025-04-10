<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\DetailTransaksiInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\DetailTransaksi;

class DetailTransaksiRepository extends BaseRepository implements DetailTransaksiInterface {

    public function __construct(DetailTransaksi $detailTransaksi) {
        $this->model = $detailTransaksi;
    }

    public function get(): mixed {
        return $this->model->query()->orderBy('id', 'DESC')->get();
    }

    public function show(mixed $id): mixed {
        return $this->model->query()->firstOrFail($id);
    }

    public function store(array $data):mixed {
        return $this->model->query()->create($data);
    }

    public function update(mixed $id, array $data): mixed {
        return $this->model->query()->findOrFail($id)->update($data);
    }

    public function delete(mixed $id): mixed {
        return $this->model->query()->findOrFail($id)->delete();
    }

    public function getAll(): mixed {
        return $this->model->query();
    }

    public function getModel(): mixed {
        return $this->model;
    }


}