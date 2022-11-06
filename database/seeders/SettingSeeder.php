<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'name'         => 'Mini Shop',
            'service_time' => 'Senin s/d Jumat (05.00 WIB s/d 16.00 WIB)',
            'address'      => 'Madura, Jawa Timur',
            'description'  => 'Tempatnya barang murah tapi tidak murahan, yuk order sekarang!',
            'logo'         => '',
            'keywords'     => 'onlshop,fashion,sayur,sembako,toko',
            'instagram'    => '',
            'facebook'     => '',
            'email'        => '',
            'whatsapp'     => '082132521665',
            'phone'        => '',
        ]);
    }
}
