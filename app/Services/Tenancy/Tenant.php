<?php

namespace App\Services\Tenancy;

use App\Services\Tenancy\Traits\TenantDatabase;
use App\Services\Tenancy\Traits\TenantDomain;
use App\Services\Tenancy\Traits\TenantStorage;

class Tenant
{
  use TenantStorage, TenantDatabase, TenantDomain;
}
