# Tenancy Documentation

### Tenant Database

- This trait provides a set of helper methods for managing tenant databases in Laravel.

**Usage:**

To use this trait, simply add it to your tenant model:

Once you have added the trait to your tenant, you can use the following methods to manage tenant databases:
**Methods:**

* **tenantDatabaseExists(int $id): bool**

This method checks if a tenant database exists for the given tenant ID.

* **switchToTenantConnection(int $id): void**

This method switches the database connection to the tenant database for the given tenant ID.

* **switchToSystemConnection(string $db_name = "system"): void**

This method switches the database connection to the system database.

* **getConnection(): array**

This method returns the current database connection.

* **getDatabaseSize(string $db_name): float**

This method returns the size of the given database in megabytes.

* **getTenantDatabaseSize(int $id): float**

This method returns the size of the tenant database for the given tenant ID.

* **runTenantMigrations(): void**

This method runs the tenant migrations.

* **runSystemMigrations(): void**

This method runs the system migrations.

* **createTenantDatabase(int $id): void**

This method creates a tenant database for the given tenant ID.

* **runSystemSeeders(): void**

This method runs the system seeders.

* **runTenantSeeders(): void**

This method runs the tenant seeders.

**Example:**

The following example shows how to use the TenantDatabase trait to switch to a tenant database:

```php
// Switch to the tenant database
$tenant = \Tenant::switchToTenantConnection(1);
```

### Tenant Storage

This trait provides a set of helper methods for managing tenant storage in Laravel.

**Usage:**

To use this trait, simply add it to your tenant model:

Once you have added the trait to your tenant, you can use the following methods to manage tenant storage:
**Methods:**

* **tenantStorageExists(int $id): bool**

This method checks if a tenant storage directory exists for the given tenant ID.

* **systemFileExists(string $fileUrl): bool**

This method checks if the system file exists.

* **tenantFileExists(int $id, string $fileUrl): bool**

This method checks if the tenant file exists.

* **createTenantStorage(int $id): void**

This method creates a new tenant storage directory.

* **getTenantSize(int $id): float**

This method gets the tenant storage directory size in megabytes.

* **putTenantFile(int $id, string $path, UploadedFile|HttpFile|array|string|null $file, array|string|null $name): void**

This method puts a file to tenant storage.

* **removeTenantDirectory(int $id, string $path): void**

This method removes a directory from tenant storage.

* **deleteTenantFile(int $id, string $full_path): void**

This method deletes a file from tenant storage.

* **getSystemFilePath(string $path): null|string**

This method gets the file path from system files.

* **getTenantFilePath(int $id, string $path): null|string**

This method gets the file path from tenant files.

* **putSystemFile(string $path, UploadedFile|HttpFile|array|string|null $file, array|string|null $name = null): void**

This method puts a file to system storage.

* **createSystemDirectory(string $path): void**

This method creates a system directory.

* **createTenantDirectory(int $id, string $path): void**

This method creates a directory inside a tenant.

* **createPublicDirectory(string $path): void**

This method creates a directory inside public directory.

**Example:**

The following example shows how to use the TenantStorage trait to put a file to tenant storage:

```php
// Put a file to tenant storage
\Tenant::putTenantFile('uploads/my-file.jpg', new UploadedFile('my-file.jpg'));

// Get the file path from tenant storage
\Tenant::getTenantFilePath(1, 'uploads/my-file.jpg');
```

### Tenant Domain

This trait provides a set of helper methods for managing tenant domains in Laravel.

**Usage:**
Once you have added the trait to your tenant, you can use the following methods to manage tenant domains:

**Methods:**

* **domains(): HasMany**

This method returns the tenant's domains.

* **createDomain(string $name): Model**

This method creates a new domain for the tenant.

* **hasDomains(array $domains): bool**

This method checks if the tenant has the given domains.

* **getDomainsName(): Collection**

This method returns the names of the tenant's domains.

* **deleteDomain(int $id): bool**

This method deletes a domain from the tenant.

**Example:**

The following example shows how to use the TenantDomain trait to create a new domain for a tenant:

```php
use App\Models\System\User;

# Get user
$user = User::find(1);

# create domain
$user->createDomain('example.com');

# get user Domains
$user->domains();
```
