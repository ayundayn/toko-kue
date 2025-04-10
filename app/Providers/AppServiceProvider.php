<?php

namespace App\Providers;

use App\Contracts\Interfaces\DetailTransaksiInterface;
use App\Contracts\Interfaces\KategoriInterface;
use App\Contracts\Interfaces\KueInterface;
use App\Contracts\Interfaces\PelangganInterface;
use App\Contracts\Interfaces\TransaksiInterface;
use App\Contracts\Repositories\DetailTransaksiRepository;
use App\Contracts\Repositories\KategoriRepository;
use App\Contracts\Repositories\KueRepository;
use App\Contracts\Repositories\PelangganRepository;
use App\Contracts\Repositories\TransaksiRepository;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Services\TransaksiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        $this->app->bind(KategoriInterface::class, KategoriRepository::class);
        $this->app->bind(PelangganInterface::class, PelangganRepository::class);
        $this->app->bind(KueInterface::class, KueRepository::class);
        $this->app->bind(TransaksiInterface::class, TransaksiService::class);
        // $this->app->bind(TransaksiRepository::class, function ($app) {
        //     return new TransaksiRepository($app->make(Transaksi::class));
        // });
        // $this->app->bind(DetailTransaksiInterface::class, function ($app) {
        //     return new DetailTransaksiRepository($app->make(DetailTransaksi::class));
        // });
        $this->app->bind(TransaksiInterface::class, TransaksiRepository::class);
        $this->app->bind(DetailTransaksiInterface::class, DetailTransaksiRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
