<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ✅ Llamar al seeder de productos (ANDINO/ECUESTRE)
        $this->call(ProductSeeder::class);

        // ✅ Usuario de prueba (opcional, para desarrollo)
        User::factory()->create([
            'name' => 'Cliente Prueba',
            'email' => 'cliente@artesania.com',
            'password' => bcrypt('Cliente1234!'),
            'email_verified_at' => now(),
        ])->assignRole('cliente');

        // ✅ Admin ya se crea en RoleSeeder, pero si quieres otro:
        // User::factory()->create([...])->assignRole('admin');
    }
}
