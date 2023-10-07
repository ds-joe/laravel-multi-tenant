<?php

namespace App\Services\Tenancy;

use App\Models\System\Domain;
use App\Models\System\User;

class Tenant
{
  /**
   * @desc This method using to create a new domain.
   * @param User $user
   * @param string $domainName
   * @return void
   */
  public function createDomain(User $user, string $domainName): void
  {
    $domain = Domain::create([
      'name' => $domainName,
      'user_id' => $user->id
    ]);
  }
}
