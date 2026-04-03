<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\KategoriMateri;
use App\Models\Materi;
use App\Policies\KategoriMateriPolicy;
use App\Policies\MateriPolicy;

use App\Models\Booking;
use App\Observers\BookingObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(KategoriMateri::class, KategoriMateriPolicy::class);
        Gate::policy(Materi::class, MateriPolicy::class);

        // register model observers
        Booking::observe(BookingObserver::class);
    }
}
