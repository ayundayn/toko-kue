<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\DetailTransaksiInterface;
use App\Contracts\Interfaces\TransaksiInterface;
use App\Http\Requests\StoreDetailTransaksiRequest;
use App\Models\DetailTransaksi;
use App\Models\Kue;
use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class DetailTransaksiController extends Controller
{
    private DetailTransaksiInterface $detailTransaksi;
    private TransaksiInterface $transaksi;

    public function __construct(DetailTransaksiInterface $detailTransaksi, TransaksiInterface $transaksi) {
        $this->detailTransaksi = $detailTransaksi;
        $this->transaksi = $transaksi;
    }

    public function index(): View {
        $detailTransaksis = $this->detailTransaksi->get();
        return view('transaksi.detail', compact('detailTransaksis'));
    }

    public function showDetailTransaksi($id): View {
        $transaksi = $this->transaksi->getDetail($id); 
        return view('transaksi.detail', compact('transaksi'));
    }    
    
}
