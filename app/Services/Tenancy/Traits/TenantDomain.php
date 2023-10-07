<?php

namespace App\Services\Tenancy\Traits;

use App\Models\System\Domain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

trait TenantDomain
{
  /**
   * @desc This method using to get domains.
   * @return HasMany
   */
  public function domains(): HasMany
  {
    return $this->hasMany(Domain::class);
  }

  /**
   * @desc This method using to create a new domain.
   * @param string $name
   * @return Model
   */
  public function createDomain(string $name): Model
  {
    return $this->domains()->create([
      'name' => $name
    ]);
  }

  /**
   * @desc This method using to check if domains | domain exists or not.
   * @param array $domains
   * @return bool
   */
  public function hasDomains(array $domains): bool
  {
    $domains = $this->domains()->whereIn('name', $domains)->first();
    return !empty($domains);
  }

  /**
   * @desc This method using to get domains names.
   * @return Collection
   */
  public function getDomainsName(): Collection
  {
    return $this->domains()->pluck('name');
  }

  /**
   * @desc This method using to delete a domain.
   * @param int $id domain id
   * @return bool
   */
  public function deleteDomain(int $id): bool
  {
    $this->domains()->where('id', $id)->delete();
    return true;
  }
}
