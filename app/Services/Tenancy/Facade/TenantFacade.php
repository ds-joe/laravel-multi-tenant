<?php

namespace App\Services\Tenancy\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string doSomething()
 */
class TenantFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return "Tenant";
  }
}
