<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nik' => rand(1000000000 , 9999999999) ,
                'nama_pegawai' => 'Ujang Hernanf=des',
                'email' => 'ujang@gmail.com',
                'password' => Hash::make('password'),
                'jenis_kelamin' => 'Laki-Laki',
                'alamat' => 'Jln. Jakarta No. 1',
                'tim' => 'Logistik',
                'agama' => 'Islam',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1990-11-1',
                'nomor_telepon' => '092019292919'
            ]            
        ];
        
        \DB::table('pegawai')->insert($data);
    }
}
