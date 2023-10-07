<?php

namespace App\Services\Tenancy;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class TenantDatabase extends TenantHelpers
{
  # Migrations information
  private string $systemMigrationsPath = "database/migrations/system";
  private string $tenantMigrationsPath = "database/migrations/tenant";

  # Seeder Information
  private string $systemSeedersTargetClass = "DatabaseSystemSeeder";
  private string $tenantSeedersTargetClass = "DatabaseTenantSeeder";

  # Connection information
  private string $tenantConnectionName = "tenant";
  private string $systemConnectionName = "system";

  /**
   * @desc This method using to switch from default database to a tenant database.
   * @param string|int $db_id
   * @return void
   */
  public function switchToTenantConnection(string|int $db_id): void
  {
    DB::purge($this->systemConnectionName);
    DB::purge($this->tenantConnectionName);
    Config::set("database.connections.{$this->tenantConnectionName}.database", "{$this->tenantAliasName}{$db_id}");
    DB::connection($this->tenantConnectionName)->reconnect();
    DB::setDefaultConnection($this->tenantConnectionName);
  }

  /**
   * @desc This method using to switch from tenant database to default database.
   * @param string $db_name
   * @return void
   */
  public function switchToSystemConnection(string $db_name = "system"): void
  {
    DB::purge($this->systemConnectionName);
    DB::purge($this->tenantConnectionName);
    Config::set("database.connections.{$this->systemConnectionName}.database", $db_name);
    DB::connection($this->systemConnectionName)->reconnect();
    DB::setDefaultConnection($this->systemConnectionName);
  }

  /**
   * @desc This method using to get current connection ( default | tenant ).
   * @return array
   */
  public function getConnection(): array
  {
    return DB::getConnections();
  }

  /**
   * @desc This method using to get database size in ( Mega Byte ).
   * @param string $db_name
   * @return float
   */
  public function getDatabaseSize(string $db_name): float|int
  {
    $query = "SELECT SUM(data_length) AS database_size FROM information_schema.tables WHERE table_schema = '$db_name'";
    $databaseSize = DB::selectOne($query)->database_size;
    return $this->convertSizeToMB($databaseSize);
  }

  /**
   * @desc This method using to run a tenant migrations. 703125 703125
   * @return void
   */
  public function runTenantMigrations(): void
  {
    Artisan::call("migrate --path={$this->tenantMigrationsPath} --database={$this->tenantConnectionName}");
  }

  /**
   * @desc This method using to run a default migrations.
   * @return void
   */
  public function runSystemMigrations(): void
  {
    Artisan::call("migrate --path={$this->systemMigrationsPath} --database={$this->systemConnectionName}");
  }

  /**
   * @desc This method using to create tenant database.
   * @param string|int $id
   * @return void
   */
  public function createNewCompanyDatabase(string|int $id): void
  {
    DB::statement("CREATE DATABASE IF NOT EXISTS {$this->tenantAliasName}{$id}");
  }

  /**
   * @desc This method using to run system seeders.
   * @return void
   */
  public function runSystemSeeders(): void
  {
    Artisan::call("db:seed --class={$this->systemSeedersTargetClass}");
  }

  /**
   * @desc This method using to run tenant seeders.
   * @return void
   */
  public function runTenantSeeders(): void
  {
    Artisan::call("db:seed --class={$this->tenantSeedersTargetClass}");
  }
}
