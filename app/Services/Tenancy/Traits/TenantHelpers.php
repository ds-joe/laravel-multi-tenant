<?php

namespace App\Services\Tenancy\Traits;

trait TenantHelpers
{
  # Aliases
  protected string $tenantAliasName = "tenant_";

  /**
   * @desc This method using to convert the relative database | files size to Mega Byte.
   * @param int|float $size
   * @return float
   */
  protected function convertSizeToMB(int|float $size): float
  {
    return (float)$size / 1024 / 1024;
  }

  /**
   * @desc This method using to convert the relative database | files size to GB.
   * @param int|float $size
   * @return float
   */
  public function convertSizeToGB(int|float $size): float
  {
    return (float)$size / (1024 * 1024);
  }
}
