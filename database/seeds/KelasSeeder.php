<?php

use Illuminate\Database\Seeder;
use App\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kelas1 = Kelas::create(['name'=>'X']);
        $kelas2 = Kelas::create(['name'=>'XI']);
        $kelas3 = Kelas::create(['name'=>'XII']);
    }
}
