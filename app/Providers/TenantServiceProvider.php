<?php

namespace App\Providers;

use App\Services\Tenancy\Facade\TenantFacade;
use App\Services\Tenancy\Tenant;
use App\Services\Tenancy\TenantDatabase;
use App\Services\Tenancy\TenantStorage;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    $this->app->bind('Tenant', function () {
      return new Tenant();
    });
    $this->app->bind("TenantStorage", function(){
      return new TenantStorage();
    });
    $this->app->bind("TenantDatabase", function (){
      return new TenantDatabase();
    });
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    //
  }
}
