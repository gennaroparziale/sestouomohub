<?php

namespace Database\Seeders;

use App\Models\CategoriaSpesa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSpesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoriaSpesa::updateOrCreate(['nome' => 'Tesseramenti']);
        CategoriaSpesa::updateOrCreate(['nome' => 'Merchandising']);
        CategoriaSpesa::updateOrCreate(['nome' => 'Costi Trasferte']);
        CategoriaSpesa::updateOrCreate(['nome' => 'Costi Materiale']);
        CategoriaSpesa::updateOrCreate(['nome' => 'Donazioni']);
    }
}
