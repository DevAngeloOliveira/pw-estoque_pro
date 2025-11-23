<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            CompanySeeder::class,
            SupplierSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductMovementSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('');
        $this->command->info('📊 Summary:');
        $this->command->info('   - 1 Admin');
        $this->command->info('   - 3 Companies');
        $this->command->info('   - 8 Suppliers (5 global + 3 company)');
        $this->command->info('   - 12 Categories');
        $this->command->info('   - 30 Products');
        $this->command->info('   - 155 Product Movements');
        $this->command->info('');
        $this->command->info('🔐 Login credentials:');
        $this->command->info('');
        $this->command->info('   ADMIN:');
        $this->command->info('   Email: admin@sistema.com | Password: admin123');
        $this->command->info('   URL: /admin/login');
        $this->command->info('');
        $this->command->info('   COMPANIES:');
        $this->command->info('   Company 1: CNPJ: 12.345.678/0001-95 | Password: senha123');
        $this->command->info('   Company 2: CNPJ: 98.765.432/0001-10 | Password: senha123');
        $this->command->info('   Company 3: CNPJ: 11.222.333/0001-44 | Password: senha123');
        $this->command->info('');
    }
}
