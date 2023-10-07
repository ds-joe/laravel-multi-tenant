<?php

namespace App\Services\Tenancy;

use App\Models\System\User;
use Illuminate\Support\Facades\Facade;

/**
 * database
 * @method static bool tenantDatabaseExists(int $id)
 * @method static void switchToTenantConnection(int $db_id)
 * @method static void switchToSystemConnection(string $db_name = "system")
 * @method static array getConnection()
 * @method static float getDatabaseSize(string $db_name)
 * @method static float getTenantDatabaseSize(int $id)
 * @method static void runTenantMigrations()
 * @method static void runSystemMigrations()
 * @method static void createTenantDatabase(int $id)
 * @method static void runSystemSeeders()
 * @method static void runTenantSeeders()
 *
 * storage
 * @method static bool tenantStorageExists(int $id)
 * @method static bool systemFileExists(string $fileUrl)
 * @method static bool tenantFileExists(int $id, string $fileUrl)
 * @method static void createTenantStorage(int $id)
 * @method static float getTenantSize(int $id)
 * @method static void putTenantFile(int $id, string $path, UploadedFile|HttpFile|array|string|null $file, array|string|null $name)
 * @method static void removeTenantDirectory(int $id, string $path)
 * @method static void deleteTenantFile(int $id, string $full_path)
 * @method static null|string getSystemFilePath(string $path)
 * @method static null|string getTenantFilePath(int $id, string $path)
 * @method static void putSystemFile(string $path, UploadedFile|HttpFile|array|string|null $file, array|string|null $name = null)
 * @method static void createSystemDirectory(string $path)
 * @method static void createTenantDirectory(string $path, int|string $id)
 * @method static void createPublicDirectory(string $path)
 *
 * domains
 *
 */
class TenantFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return "Tenant";
  }
}
