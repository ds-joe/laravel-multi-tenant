<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SystemMigrations extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'system:migrate';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Using to run system migrations.';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $this->info("Run migrations...");
    \TenantDatabase::runSystemMigrations();
    $this->info("Migrations created successfully.");
  }
}
