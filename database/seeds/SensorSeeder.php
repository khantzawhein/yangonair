<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sensors')->insert([
            'sensor_id' => '9628',
            'sensor_name' => 'Myanmar Centre for Responsible Business',
            'township' => 'Ahlone',
            'lat' => 16.79512400,
            'long' => 96.12952100,
            'api_vendor' => 'PurpleAir',
            'api_url' => 'http://www.purpleair.com/json?show=9628'
        ]);
        DB::table('sensors')->insert([
            'sensor_id' => '36553',
            'sensor_name' => 'Yangon-HO',
            'township' => 'Bahan',
            'lat' => 16.80609600,
            'long' => 96.14570200,
            'api_vendor' => 'PurpleAir',
            'api_url' => 'http://www.purpleair.com/json?show=36553'
        ]);
        DB::table('sensors')->insert([
            'sensor_id' => '20389',
            'sensor_name' => 'Yangon International School*',
            'township' => 'Thin Gan Gyun',
            'lat' => 16.82608400,
            'long' => 96.19235400,
            'api_vendor' => 'PurpleAir',
            'api_url' => 'http://www.purpleair.com/json?show=20389'
        ]);
        DB::table('sensors')->insert([
            'sensor_id' => '33329',
            'sensor_name' => 'American Center Yangon',
            'township' => 'Kamayut',
            'lat' => 16.82612400,
            'long' => 96.13980500,
            'api_vendor' => 'PurpleAir',
            'api_url' => 'http://www.purpleair.com/json?show=33329'
        ]);
        DB::table('sensors')->insert([
            'sensor_id' => '26285',
            'sensor_name' => 'GEMS Condo',
            'township' => 'Hlaing',
            'lat' => 16.84287400,
            'long' => 96.12862800,
            'api_vendor' => 'PurpleAir',
            'api_url' => 'http://www.purpleair.com/json?show=26285'
        ]);
        DB::table('sensors')->insert([
            'sensor_id' => '31425',
            'sensor_name' => 'UNOPS Myanmar',
            'township' => 'Mayangone',
            'lat' => 16.85701400,
            'long' => 96.13845600,
            'api_vendor' => 'PurpleAir',
            'api_url' => 'http://www.purpleair.com/json?show=31425'
        ]);
        
        DB::table('sensors')->insert([
            'sensor_id' => '9578',
            'sensor_name' => '7 Mile Mayangone',
            'township' => 'Mayangone',
            'lat' => 16.85683100,
            'long' => 96.14652300,
            'api_vendor' => 'PurpleAir',
            'api_url' => 'http://www.purpleair.com/json?show=9578'
        ]);
        DB::table('sensors')->insert([
            'sensor_id' => '9618',
            'sensor_name' => 'Dulwich College Yangon (Pun Hlaing)',
            'township' => 'Hlaingthayar',
            'lat' => 16.84409100,
            'long' => 96.08825900,
            'api_vendor' => 'PurpleAir',
            'api_url' => 'http://www.purpleair.com/json?show=9618'
        ]);
        DB::table('sensors')->insert([
            'sensor_id' => '24049',
            'sensor_name' => 'Jasmin Gardens',
            'township' => 'Hlaingthayar',
            'lat' => 16.83966000,
            'long' => 96.09543100,
            'api_vendor' => 'PurpleAir',
            'api_url' => 'http://www.purpleair.com/json?show=24049'
        ]);
        DB::table('sensors')->insert([
            'sensor_id' => '20391',
            'sensor_name' => 'Dulwich College Yangon (Star City)',
            'township' => 'Thanlyin',
            'lat' => 16.77033600,
            'long' => 96.22851800,
            'api_vendor' => 'PurpleAir',
            'api_url' => 'http://www.purpleair.com/json?show=20391'
        ]);
        DB::table('sensors')->insert([
            'sensor_id' => '26359',
            'sensor_name' => 'Beca Consultant',
            'township' => 'Kamayut',
            'lat' => 16.82103800,
            'long' => 96.12690000,
            'api_vendor' => 'PurpleAir',
            'api_url' => 'http://www.purpleair.com/json?show=26359'
        ]);
    }
}
