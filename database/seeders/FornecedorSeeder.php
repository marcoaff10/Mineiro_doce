<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fornecedores')->insert([
            [
                'fornecedor' => 'João',
                'email' => 'teste@teste.com',
                'cnpj' => '44.381.082/0001-37',
                'telefone' => '(35) 999480107',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'fornecedor' => 'Maria',
                'email' => 'teste@teste.com',
                'cnpj' => '26.281.848/0001-20',
                'telefone' => '(35) 999480107',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'fornecedor' => 'José',
                'email' => 'teste@teste.com',
                'cnpj' => '71.241.067/0001-66',
                'telefone' => '(35) 999480107',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'fornecedor' => 'Joaquim',
                'email' => 'teste@teste.com',
                'cnpj' => '22.511.535/0001-60',
                'telefone' => '(35) 999480107',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}
