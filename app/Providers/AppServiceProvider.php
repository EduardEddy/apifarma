<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// ** Models **
use App\Models\User;
use App\Models\ResetPassword;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Store;
use App\Models\StoreSeller;
use App\Models\AddressUser;

// ** Observers **
use App\Observers\Users\UserObserver;
use App\Observers\Password\PasswordResetObserver;
use App\Observers\Products\ProductObserver;
use App\Observers\Invoices\InvoiceObserver;
use App\Observers\Stores\StoreObserver;
use App\Observers\Stores\StoreSellerObserver;
use App\Observers\Users\AddressUserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);

        ResetPassword::observe(PasswordResetObserver::class);

        Product::observe(ProductObserver::class);

        Invoice::observe(InvoiceObserver::class);

        Store::observe(StoreObserver::class);

        StoreSeller::observe(StoreSellerObserver::class);

        AddressUser::observe(AddressUserObserver::class);
    }
}
