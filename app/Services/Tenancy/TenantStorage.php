<?php

namespace App\Services\Tenancy;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class TenantStorage extends TenantHelpers
{
  # Storage Disks
  private array $tenantDisk = [];
  private array $systemDisk = [];
  private array $publicDisk = [];

  public function __construct()
  {
    $this->tenantDisk = Config::get("filesystems.disks.tenant");
    $this->systemDisk = Config::get("filesystems.disks.system");
    $this->publicDisk = Config::get("filesystems.disks.public");
  }

  /**
   * @desc This method using to check if tenant directory is exists.
   * @param int|string $id
   * @return bool
   */
  public function tenantDirectoryExists(int|string $id): bool
  {
    return Storage::disk($this->tenantDisk['name'])->exists("{$this->tenantAliasName}{$id}");
  }

  /**
   * @desc This method using to check if the system file exists or not.
   * @param string $fileUrl
   * @return bool
   */
  public function systemFileExists(string $fileUrl): bool
  {
    return Storage::disk($this->systemDisk['name'])->fileExists($fileUrl);
  }

  /**
   * @desc This method using to check if tenant file exists or not.
   * @param int|string $id tenant id
   * @param string $fileUrl
   * @return bool
   */
  public function tenantFileExists(int|string $id, string $fileUrl): bool
  {
    return Storage::disk($this->tenantDisk['name'])->fileExists("{$this->tenantAliasName}{$id}/{$fileUrl}");
  }

  /**
   * @desc This method using to create a new tenant directory.
   * @param int|string $id
   * @return void
   */
  public function newTenantDirectory(string|int $id): void
  {
    if (!$this->tenantDirectoryExists($id)) {
      Storage::disk($this->tenantDisk['name'])->createDirectory("{$this->tenantAliasName}{$id}");
    }
  }

  /**
   * @desc This method using to get tenant directory size in (Mega Byte)  :).
   * @param string|int $id
   * @return float|int
   */
  public function getTenantSize(int|string $id)
  {
    $totalSize = 0;
    $directories = Storage::disk($this->tenantDisk['name'])->directories("{$this->tenantAliasName}{$id}", true);
    foreach ($directories as $directory) {
      $files = Storage::disk($this->tenantDisk['name'])->allFiles($directory);
      foreach ($files as $file) {
        $totalSize += Storage::disk($this->tenantDisk['name'])->size($file);
      }
    }
    return $this->convertSizeToMB($totalSize);
  }

  /**
   * @desc This method using to put files to tenant directory.
   * @param string|int $id tenant id
   * @param string $path
   * @param UploadedFile|HttpFile|array|string|null $file
   * @param array|string|null $name
   * @return void
   */
  public function putTenantFile(int $id, string $path, UploadedFile|HttpFile|array|string|null $file, array|string|null $name): void
  {
    Storage::disk($this->tenantDisk['name'])->putFileAs("{$this->tenantAliasName}{$id}/{$path}", $file, $name);
  }

  /**
   * @desc This method using to remove a directory from tenant files.
   * @param int|string $id tenant id
   * @param string $path
   * @return void
   */
  public function removeTenantDirectory(int|string $id, string $path): void
  {
    Storage::disk($this->tenantDisk['name'])->deleteDirectory("{$this->tenantAliasName}{$id}/{$path}");
  }

  /**
   * @desc This method using to remove a file from tenant.
   * @param int|string $id tenant id
   * @param string $full_path like the path or directory and full file name.
   * @return void
   */
  public function deleteTenantFile(int|string $id, string $full_path): void
  {
    Storage::disk($this->tenantDisk['name'])->delete("{$this->tenantAliasName}{$id}/{$full_path}");
  }

  /**
   * @desc This method using to get file path from system files.
   * @param string $path
   * @return null|string
   */
  public function getSystemFilePath(string $path): null|string
  {
    $filePath = Storage::disk($this->systemDisk['name'])->path($path);
    $shortPath = Str::after($filePath, Storage::disk($this->systemDisk['name'])->path(''));
    $shortPath = str_replace('\\', '/', $shortPath);
    return '/storage/' . $this->systemDisk['name'] . "/" . $shortPath;
  }

  /**
   * @desc This method using to get file path from tenant files.
   * @param string $path
   * @param int|string $id
   * @return null|string
   */
  public function getTenantFilePath(int|string $id, string $path): null|string
  {
    $filePath = Storage::disk($this->tenantDisk['name'])->path("{$this->tenantAliasName}{$id}/{$path}");
    $shortPath = Str::after($filePath, Storage::disk($this->tenantDisk['name'])->path(''));
    $shortPath = str_replace('\\', '/', $shortPath);
    return '/storage/' . $this->tenantDisk['name'] . "/" . $shortPath;
  }

  /**
   * @desc This method using to put files to system directory.
   * @param string $path
   * @param UploadedFile|HttpFile|array|string|null $file
   * @param array|string|null $name
   * @return void
   */
  public function putSystemFile(string $path, UploadedFile|HttpFile|array|string|null $file, array|string|null $name = null): void
  {
    Storage::disk($this->systemDisk['name'])->putFileAs($path, $file, $name);
  }

  /**
   * @desc This method using to create a system directory.
   * @param string $path
   * @return void
   */
  public function createSystemDirectory(string $path): void
  {
    Storage::disk($this->systemDisk['name'])->makeDirectory($path);
  }

  /**
   * @desc This method using to create a directory inside a tenant.
   * @param string $path
   * @param int|string $id
   * @return void
   */
  public function createTenantDirectory(string $path, int|string $id): void
  {
    if (!$this->tenantDirectoryExists($id)) {
      Storage::disk($this->tenantDisk['name'])->makeDirectory("{$this->tenantAliasName}{$id}/{$path}");
    }
  }

  /**
   * @desc This method using to create a directory inside public directory.
   * @param string $path
   * @return void
   */
  public function createPublicDirectory(string $path): void
  {
    Storage::disk($this->publicDisk['name'])->makeDirectory($path);
  }
}
