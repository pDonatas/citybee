<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = [
            ['id' => 1, 'model' => 'Volkswagen Golf', 'year' => 2018, 'status' => 'Available',
                'registration_date' => '2020-08-20', 'pay_per_minute' => 0.5 , 'number_plate' => 'HGH625',
                'maintenance_end' => '2022-07-23' , 'insurance_end' => '2021-07-23', 'registration_certificate_number' => 'BH156GUY25'],
            ['id' => 2, 'model' => 'Toyota Corolla', 'year' => 2019, 'status' => 'Available',
                'registration_date' => '2020-08-23', 'pay_per_minute' => 0.6 , 'number_plate' => 'JKL986',
                'maintenance_end' => '2022-07-26' , 'insurance_end' => '2021-07-26', 'registration_certificate_number' => 'JGL653DFR89']


        ];
        DB::table('cars')->insert($cars);
    }
}
