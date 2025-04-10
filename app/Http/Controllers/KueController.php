<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\KategoriInterface;
use App\Contracts\Interfaces\KueInterface;
use App\Contracts\Repositories\KueRepository;
use App\Http\Requests\StoreKueRequest;
use App\Http\Requests\UpdateKueRequest;
use App\Models\Kategori;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Kue;

class KueController extends Controller
{
    private KueInterface $kue;
    private KategoriInterface $kategori;
    
    public function __construct(KueInterface $kue, KategoriInterface $kategori) {
        $this->kue = $kue;
        $this->kategori = $kategori;
    }

    public function index(): View {
        $kues = $this->kue->get();
        $kategoris = $this->kategori->get();

        // dd($kues);
        
        return view('dashboard', compact('kues', 'kategoris'));
    }

    public function create(): View {
        $kategoris = $this->kategori->get();
        return view('kue.create', compact('kategoris'));
    }

    public function store(StoreKueRequest $request): RedirectResponse {
        try {
            $this->kue->store($request->validated());
            Alert::success('Berhasil', 'Kue Berhasil Ditambahkan');
            return redirect()->route('dashboard');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Gagal', 'Silakan periksa kembali form Anda');
            return back()->withErrors($e->validator)->withInput();
        }
    }    

    public function showKue(Kue $kue): View {
        $kues = $this->kue->get();
        return view('dashboard', compact('kues'));
    }

    public function edit(Kue $kue): View {
        $kategoris = $this->kategori->get();
        return view('kue.edit', compact('kue', 'kategoris'));
    }

    public function update(UpdateKueRequest $request, Kue $kue) {
        try {
            $this->kue->update($kue->id, $request->validated());
            Alert::success('Berhasil', 'Kue Berhasil Diperbarui');
            return redirect()->route('dashboard');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Gagal', 'Silakan periksa kembali form Anda');
            return back()->withErrors($e->validator)->withInput();
        }
    }    

    public function destroy(Kue $kue) {
        try {
            $this->kue->delete($kue->id);
            Alert::success('Berhasil', 'Kue Berhasil Dihapus');
            return back();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                Alert::error('Gagal', 'Kue Belum Dihapus');
                return to_route('dashboard');
            }
        }
        Alert::success('Berhasil', 'Kue Berhasil Dihapus');
        return redirect()->route('dashboard');
    }
}
                            