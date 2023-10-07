<?php

namespace App\Services\Tenancy\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void switchToTenantConnection(string|int $db_id)
 * @method static void switchToSystemConnection(string $db_name = "system")
 * @method static array getConnection()
 * @method static float|int getDatabaseSize(string $db_name)
 * @method static void runTenantMigrations()
 * @method static void runSystemMigrations()
 * @method static void createNewCompanyDatabase(string|int $id)
 * @method static void runSystemSeeders()
 * @method static void runTenantSeeders()
 *
 */
class TenantDatabaseFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return "TenantDatabase";
  }
}
