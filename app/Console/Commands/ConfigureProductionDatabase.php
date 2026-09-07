<?php

namespace App\Console\Commands;

use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

#[Signature('app:configure-production-database')]
#[Description('Configure la base de données pour une installation ou un déploiement en production')]
class ConfigureProductionDatabase extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $database = config('database.connections.sqlite.database');

        if (config('database.default') === 'sqlite' && $database !== ':memory:') {
            $directory = dirname($database);
            File::ensureDirectoryExists($directory);
            File::chmod($directory, 0775);

            if (! File::exists($database)) {
                File::put($database, '');
                $this->components->info("Fichier SQLite créé : {$database}");
            }

            File::chmod($database, 0664);
        }

        if ($this->call('migrate', ['--force' => true]) !== self::SUCCESS) {
            return self::FAILURE;
        }

        if ($this->call('db:seed', [
            '--class' => RolesAndPermissionsSeeder::class,
            '--force' => true,
        ]) !== self::SUCCESS) {
            return self::FAILURE;
        }

        $this->components->info('Base de données de production configurée.');

        return self::SUCCESS;
    }
}
