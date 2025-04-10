<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\DetailTransaksiInterface;
use App\Contracts\Interfaces\KueInterface;
use App\Contracts\Interfaces\PelangganInterface;
use App\Contracts\Interfaces\TransaksiInterface;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Transaksi;
use App\Services\TransaksiService;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    protected $transaksiService;
    private KueInterface $kue;
    private PelangganInterface $pelanggan;
    private DetailTransaksiInterface $detailTransaksi;

    public function __construct(TransaksiService $transaksiService, KueInterface $kue, PelangganInterface $pelanggan, DetailTransaksiInterface $detailTransaksi) {
        $this->transaksiService = $transaksiService;
        $this->kue = $kue;
        $this->pelanggan = $pelanggan;
        $this->detailTransaksi = $detailTransaksi;   
    }

    public function index(): View {
        $transaksis = $this->transaksiService->get();
        $kues = $this->kue->get();
        $pelanggans = $this->pelanggan->get();
        $detailTransaksis = $this->detailTransaksi->get();

        return view('transaksi.index', compact('transaksis', 'kues', 'pelanggans', 'detailTransaksis'));
    }

    public function create(Transaksi $transaksi): View {
        $kues = $this->kue->get();
        $pelanggans = $this->pelanggan->get();
        $detailTransaksis = $this->detailTransaksi->get();

        return view('transaksi.create', compact('transaksi', 'kues', 'pelanggans', 'detailTransaksis'));
    }

    public function store(StoreTransaksiRequest $request): RedirectResponse
    {
        try {
            $this->transaksiService->store($request->validated());
            Alert::success('Berhasil', 'Transaksi berhasil ditambahkan!');
            return redirect()->route('transaksi.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Gagal', 'Silakan periksa kembali form Anda');
            return back()->withErrors($e->validator)->withInput();
        }
    }

    public function showTransaksi(Transaksi $transaksi): View {
        $transaksis = $this->transaksiService->get();
        $kues = $this->kue->get();
        $pelanggans = $this->pelanggan->get();
        $detailTransaksis = $this->detailTransaksi->get();

        return view('transaksi.index', compact('transaksis', 'kues', 'pelanggans', 'detailTransaksis'));
    }

    public function edit(Transaksi $transaksi): View { 
        $transaksi->metode_bayar = (string) $transaksi->metode_bayar;       
        $kues = $this->kue->get();
        $pelanggans = $this->pelanggan->get();
        $detailTransaksis = $this->detailTransaksi->get();

        // dd(vars: $transaksi->metode_bayar);

        return view('transaksi.edit', compact('transaksi', 'kues', 'pelanggans', 'detailTransaksis'));
    }

    public function update(UpdateTransaksiRequest $request, $id): RedirectResponse {
        try {
            $validated = $request->validated();
            
            // Pastikan metode_bayar tersimpan
            $validated['metode_bayar'] = $request->input('metode_bayar');

            // dd("Masuk ke controller update", $id, $request->validated());

            $this->transaksiService->update($id, $validated);
            Alert::success('Berhasil', 'Transaksi berhasil diperbarui!');
            return redirect()->route('transaksi.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Silakan periksa kembali form Anda');
            return back()->withErrors($e->getMessage())->withInput();
        }
    } 

    public function destroy(Transaksi $transaksi) {
        try {
            $this->transaksiService->delete($transaksi->id);
            Alert::success('Berhasil', 'Transaksi berhasil dihapus!');
            return back();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                Alert::error('Gagal', 'Transaksi tidak dapat dihapus karena masih memiliki keterkaitan.');
                return to_route('transaksi.index');
            }
        }
        Alert::success('Berhasil', 'Transaksi berhasil dihapus!');
        return redirect()->route('transaksi.index');
    }

    public function detail($id)
    {
        $transaksis = $this->transaksiService->getDetail($id);
        $kues = $this->kue->get();
        $pelanggans = $this->pelanggan->get();
        $detailTransaksis = $this->detailTransaksi->get();
        
        if (!$transaksis) {
            Alert::error('Gagal', 'Transaksi tidak ditemukan!');
            return redirect()->route('transaksi.index');
        }
    
        return view('transaksi.detail', compact('transaksis', 'kues', 'pelanggans', 'detailTransaksis'));
    }
}
