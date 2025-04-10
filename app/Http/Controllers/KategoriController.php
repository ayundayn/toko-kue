<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\KategoriInterface;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    private KategoriInterface $kategori;

    public function __construct(KategoriInterface $kategori) {
        $this->kategori = $kategori;
    }

    public function index(): View {
        $kategoris = $this->kategori->get();

        return view('kategori.index', compact('kategoris'));
    }

    public function create(): View {
        return view('kategori.create');
    }

    public function store(StoreKategoriRequest $request): RedirectResponse {
        try {
            $this->kategori->store($request->validated());
            Alert::success('Berhasil', 'Kategori Berhasil Ditambahkan');
            return redirect()->route('kategori.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Gagal', 'Silakan periksa kembali form Anda');
            return back()->withErrors($e->validator)->withInput();
        }
    }    

    public function showKategori(Kategori $kategori): View {
        $kategoris = $this->kategori->get();
        return view('kategori.index', compact('kategoris'));
    }

    public function edit(Kategori $kategori): View {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(UpdateKategoriRequest $request, Kategori $kategori) {
        try {
            $kategori->update($request->validated());
            Alert::success('Berhasil', 'Kategori Berhasil Diperbarui');
            return redirect()->route('kategori.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Gagal', 'Silakan periksa kembali form Anda');
            return back()->withErrors($e->validator)->withInput();
        }
    }    

    public function destroy(Kategori $kategori) {
        try {
            $this->kategori->delete($kategori->id);
            Alert::success('Berhasil', 'Kategori Berhasil Dihapus');
            return back();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                Alert::error('Gagal', 'Kategori Belum Dihapus');
                return to_route('kategori.index');
            }
        }
        session()->flash('alert.config', [
            'icon' => 'success',
            'title' => 'Berhasil',
            'text' => 'Kategori Berhasil Dihapus'
        ]);
        return redirect()->route('kategori.index');
    }

}
