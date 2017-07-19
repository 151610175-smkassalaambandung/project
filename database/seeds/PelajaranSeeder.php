<?php

use Illuminate\Database\Seeder;
use App\Pelajaran;

class PelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $pelajaran1 = Pelajaran::create(['name'=>'Matematika']);
        $pelajaran2 = Pelajaran::create(['name'=>'IPA']);
        $pelajaran3 = Pelajaran::create(['name'=>'Bahasa Indonesia']);
    }
}
