<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder {
    public function run(): void {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleCliente = Role::create(['name' => 'cliente']);
        $roleArtesano = Role::create(['name' => 'artesano']);

        Permission::create(['name' => 'ver_dashboard']);
        Permission::create(['name' => 'gestionar_productos']);
        Permission::create(['name' => 'ver_pedidos']);
        Permission::create(['name' => 'gestionar_usuarios']);

        $roleAdmin->givePermissionTo(Permission::all());
        $roleCliente->givePermissionTo('ver_dashboard');
        $roleArtesano->givePermissionTo(['ver_dashboard', 'gestionar_productos']);

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@artesania.com',
            'password' => bcrypt('Admin1234!'),
            'email_verified_at' => now(),
        ])->assignRole('admin');
    }
}