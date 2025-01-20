<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class alumno extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alumno')->insert([
            'nombre' => Str::random(32),
            'telefono' => mt_rand(1000000000000000, 9999999999999999),
            'edad' => random_int(1, 99),
            'email' => Str::random(64).'@example.com',
            'password' => Hash::make('password'),
            'sexo'=> 'M'
        ]);
    }
}
