<?php

namespace App\Services;

use App\Contracts\Interfaces\TransaksiInterface;
use App\Contracts\Interfaces\KueInterface;
use App\Contracts\Interfaces\PelangganInterface;
use App\Contracts\Interfaces\DetailTransaksiInterface;
use Illuminate\Support\Facades\DB;

class TransaksiService
{
    protected TransaksiInterface $transaksi;
    protected KueInterface $kue;
    protected PelangganInterface $pelanggan;
    protected DetailTransaksiInterface $detailTransaksi;

    public function __construct(TransaksiInterface $transaksi, KueInterface $kue, PelangganInterface $pelanggan, DetailTransaksiInterface $detailTransaksi) {
        $this->transaksi = $transaksi;
        $this->kue = $kue;
        $this->pelanggan = $pelanggan;
        $this->detailTransaksi = $detailTransaksi;
    }

    public function get(): mixed
    {
        return $this->transaksi->get();
    }

    public function store(array $data): mixed
    {
        return DB::transaction(function () use ($data) {
            $transaksi = $this->transaksi->store([
                'pelanggan_id' => $data['pelanggan_id'],
                'total_harga' => $data['total_harga'],
                'metode_bayar' => $data['metode_bayar'],
            ]);

            $this->createDetailTransaksi($transaksi->id, $data);
            return $transaksi;
        });
    }

    public function show(mixed $id): mixed
    {
        return $this->transaksi->show($id);
    }

    public function getDetail($id): mixed
    {
        return $this->getDetail($id);
    }

    public function getEditData($id): array
    {
        return [
            'transaksi' => $this->show($id),
            'kues' => $this->kue->get(),
            'pelanggans' => $this->pelanggan->get(),
        ];
    }

    public function update(mixed $id, array $data): mixed
    {
        return DB::transaction(function () use ($id, $data) {
            $this->restoreStokFromOldDetails($id);
            $this->deleteDetailTransaksi($id);

            $this->transaksi->update($id, [
                'pelanggan_id' => $data['pelanggan_id'],
                'total_harga' => $data['total_harga'],
                'metode_bayar' => $data['metode_bayar'],
            ]);

            $this->createDetailTransaksi($id, $data);
            return $this->show($id);
        });
    }

    public function delete(mixed $id): mixed
    {
        return DB::transaction(function () use ($id) {
            $this->restoreStokFromOldDetails($id);
            $this->deleteDetailTransaksi($id);
            return $this->transaksi->delete($id);
        });
    }

    private function createDetailTransaksi($transaksiId, array $data): void
    {
        $detailData = [];

        foreach ($data['kue_id'] as $index => $kueId) {
            $kue = $this->kue->show($kueId);
            if ($kue) {
                $jumlah = $data['jumlah_kue'][$index];
                $detailData[] = [
                    'transaksi_id' => $transaksiId,
                    'kue_id' => $kueId,
                    'jumlah_kue' => $jumlah,
                    'total_harga' => $jumlah * $kue->harga,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Update stok kue
                $this->kue->update($kueId, [
                    'stok' => $kue->stok - $jumlah
                ]);
            }
        }

        $this->detailTransaksi->getModel()->insert($detailData);
    }

    private function restoreStokFromOldDetails($transaksiId): void
    {
        $details = $this->detailTransaksi->getModel()->where('transaksi_id', $transaksiId)->get();

        foreach ($details as $detail) {
            $kue = $this->kue->show($detail->kue_id);
            if ($kue) {
                $this->kue->update($kue->id, [
                    'stok' => $kue->stok + $detail->jumlah_kue
                ]);
            }
        }
    }

    private function deleteDetailTransaksi($transaksiId): void
    {
        $this->detailTransaksi->getModel()->where('transaksi_id', $transaksiId)->delete();
    }
}
