<?php

namespace App\Services\Tenancy\Facade;

use Illuminate\Http\File as HttpFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * @var array $tenantDisk
 * @var array $systemDisk
 * @var array $publicDisk
 * @method static bool tenantDirectoryExists(int|string $id)
 * @method static bool systemFileExists(string $fileUrl)
 * @method static bool tenantFileExists(int|string $id, string $fileUrl)
 * @method static void newTenantDirectory(string|int $id)
 * @method static float|int getTenantSize(string|int $id)
 * @method static void putTenantFile(int $id, string $path, UploadedFile|HttpFile|array|string|null $file, array|string|null $name)
 * @method static void removeTenantDirectory(int|string $id, string $path)
 * @method static void deleteTenantFile(int|string $id, string $full_path)
 * @method static null|string getSystemFilePath(string $path)
 * @method static null|string getTenantFilePath(int|string $id, string $path)
 * @method static void putSystemFile(string $path, UploadedFile|HttpFile|array|string|null $file, array|string|null $name = null)
 * @method static void createSystemDirectory(string $path)
 * @method static void createTenantDirectory(string $path, int|string $id)
 * @method static void createPublicDirectory(string $path)
 */
class TenantStorageFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return "TenantStorage";
  }
}
