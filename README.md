## laravel-multi-tenant
This template provides a boilerplate for developing multi-tenant Laravel applications. It includes support for both multi-database and single-database tenancy, as well as a file system for storing tenant-specific data.

### Installation
- **Vite installer**
```shell
npm install
```
- **Run system migrations**
```shell
  php artisan system:migrate
```

### Run Application
- **Server Side**
```shell
npm run backend
```
- **Front end**
```shell
npm start
```

### Information
- you will find database plan in `public/database-plan.drawio`

### Tenant Utilities
- Tenant Storage `app/services/TenantStorage.php`
- Tenant Database `app/services/TenantData.php`
