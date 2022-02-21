<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
//        DB::table('users')->insert([
//            'name' => Str::random(10),
//            'email' => Str::random(10).'@gmail.com',
//            'password' => Hash::make('password'),
//        ]);

        DB::table('users')->insert([
            'name' => 'Asfand Afridi',
            'email'=> 'email@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
        DB::table('companies')->insert([
        [
            'company_name' => 'Raza Khan Special',
            'contact_person'=> 'Much',
            'address' =>'',
            'phone' => '',
        ],
        [
            'company_name' => 'Raza Khan Super',
            'contact_person'=> 'Much',
            'address' =>'',
            'phone' => '',
        ],
        [
            'company_name' => 'Gillani BCC',
            'contact_person'=> 'Quetta',
            'address' =>'',
            'phone' => '',
        ],
        [
            'company_name' => 'Habib Ullah',
            'contact_person'=> 'Quetta',
            'address' =>'',
            'phone' => '',
        ],
        [
            'company_name' => 'Rehan',
            'contact_person'=> 'Quetta',
            'address' =>'',
            'phone' => '',
        ],
        ]);
        DB::table('parties')->insert([
            [
                'party_name' => 'Muhammad Noor',
                'contact_person'=> 'Much',
                'address' =>'',
                'phone' => '',
            ],
            [
                'party_name' => 'Haji Habeeb Ullah Goods',
                'contact_person'=> 'Much',
                'address' =>'',
                'phone' => '',
            ],
            [
                'party_name' => 'Rana Latif',
                'contact_person'=> 'Much',
                'address' =>'',
                'phone' => '',
            ],
            [
            'party_name' => 'Usman Mari',
            'contact_person'=> 'Much',
            'address' =>'',
            'phone' => '',
            ],
            [
                'party_name' => 'Masood Majeed(New)',
                'contact_person'=> 'Much',
                'address' =>'',
                'phone' => '',
            ],
            [
                'party_name' => 'Usman Fresh',
                'contact_person'=> 'Much',
                'address' =>'',
                'phone' => '',
            ],
            [
                'party_name' => 'Chudhary Mushtaq',
                'contact_person'=> 'Much',
                'address' =>'',
                'phone' => '',
            ],
            [
                'party_name' => 'Saeed Sadbahar New',
                'contact_person'=> 'Much',
                'address' =>'',
                'phone' => '',
            ]
        ]);
        DB::table('qualities')->insert([
            [
                'quality' => 'Special',
                'description'=> '',
            ],
            [
                'quality' => 'Ordinary',
                'description'=> '',
            ],
            [
                'quality' => 'Super',
                'description'=> '',
            ],
            [
                'quality' => 'PR-MS',
                'description'=> '',
            ],
            [
                'quality' => 'SD-110',
                'description'=> '',
            ],
            [
                'quality' => '58-A',
                'description'=> '',
            ],
            [
                'quality' => '113',
                'description'=> '',
            ],
            [
                'quality' => '58-b',
                'description'=> '',
            ],
            [
                'quality' => 'X-Tunel',
                'description'=> '',
            ],
            [
                'quality' => 'BCC',
                'description'=> '',
            ]
        ]);
    }
}
