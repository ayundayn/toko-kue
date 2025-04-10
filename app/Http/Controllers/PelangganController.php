<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\PelangganInterface;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Models\Pelanggan;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class PelangganController extends Controller
{
    private PelangganInterface $pelanggan;

    public function __construct(PelangganInterface $pelanggan) {
        $this->pelanggan = $pelanggan;
    }

    public function index(): View {
        $pelanggans = $this->pelanggan->get();
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create(): View {
        return view('pelanggan.create');
    }

    public function store(StorePelangganRequest $request): RedirectResponse {
        try {
            $this->pelanggan->store($request->validated());
            Alert::success('Berhasil', 'Pelanggan Berhasil Ditambahkan');
            return redirect()->route('pelanggan.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Gagal', 'Silakan periksa kembali form Anda');
            return back()->withErrors($e->validator)->withInput();
        }
    }

    public function showPelanggan(Pelanggan $pelanggan): View {
        $pelanggans = $this->pelanggan->get();
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function edit(Pelanggan $pelanggan): View {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan) {
        try {
            $pelanggan->update($request->validated());
            Alert::success('Berhasil', 'Data Pelanggan Berhasil Diperbarui');
            return redirect()->route('pelanggan.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Gagal', 'Silakan periksa kembali form Anda');
            return back()->withErrors($e->validator)->withInput();
        }
    }    

    public function destroy(Pelanggan $pelanggan) {
        try {
            $this->pelanggan->delete($pelanggan->id);
            Alert::success('Berhasil', 'Pelanggan Berhasil Dihapus');
            return back();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                Alert::error('Gagal', 'Pelanggan Belum Dihapus');
                return to_route('pelanggan.index');
            }
        }
        Alert::success('Berhasil', 'Pelanggan Berhasil Dihapus');
        return redirect()->route('Pelanggan.index');
    }
}
