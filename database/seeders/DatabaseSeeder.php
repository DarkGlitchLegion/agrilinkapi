<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            throw new RuntimeException('Demo seed data can only be loaded in local or testing environments.');
        }

        DB::transaction(function (): void {
            $this->call([
                GeographySeeder::class,
                RolePermissionSeeder::class,
                UserSeeder::class,
                ProductSeeder::class,
                BuyerSeeder::class,
                CommerceSeeder::class,
                MarketIntelligenceSeeder::class,
                KnowledgeSeeder::class,
                NotificationSeeder::class,
            ]);
        });
    }
}
