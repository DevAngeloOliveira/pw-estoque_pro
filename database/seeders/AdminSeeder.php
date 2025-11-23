<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin padrão do sistema
        Admin::create([
            'name' => 'Administrador',
            'email' => 'admin@sistema.com',
            'password' => Hash::make('admin123'),
            'super_admin' => true,
            'active' => true,
        ]);

        $this->command->info('Admin criado com sucesso!');
        $this->command->info('Email: admin@sistema.com | Senha: admin123');
    }
}
