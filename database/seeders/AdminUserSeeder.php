<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Crear el rol si no existe
        $adminRole = Role::firstOrCreate([
            'name' => 'Administrador',
        ]);

        // Crear el usuario
        $adminUser = User::firstOrCreate([
            'email' => 'alejandro1804@gmail.com',
        ], [
            'name' => 'Alejandro',
            'password' => Hash::make('12345678'), // Cambiar por algo más seguro
        ]);

        // Asignar el rol
       // $adminUser->roles()->syncWithoutDetaching([$adminRole->id]);

        $adminUser->role()->associate($adminRole);
        $adminUser->save();

        // Si usás posiciones, podrías agregar algo como:
        // $adminUser->position()->associate(Position::firstOrCreate(['name' => 'Gerente']));
        // $adminUser->save();
    }
}

