<?php

namespace App\Contracts\Repositories;

use App\Models\Transaksi;
use App\Contracts\Interfaces\TransaksiInterface;

class TransaksiRepository extends BaseRepository implements TransaksiInterface {

    public function __construct(Transaksi $transaksi) {
        $this->model = $transaksi;
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

    public function getDetail($id): mixed {
        return $this->model
            ->with(['detailTransaksi.kue', 'pelanggan'])
            ->findOrFail($id);
    }
    
}