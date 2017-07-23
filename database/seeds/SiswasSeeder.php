<?php

use Illuminate\Database\Seeder;
use App\Kelas;
use App\Jurusan;
use App\Siswa;

class SiswasSeeder extends Seeder
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

        $jurusan1 = Jurusan::create(['name'=>'Informatika']);

        $siswa1 = Siswa::create(['nis'=>'151610','name'=>'Aceng','jeniskelamin'=>'Laki-laki','alamat'=>'Jln Sribaduga','kelas_id'=>$kelas1->id,'jurusan_id'=>$jurusan1->id]);
    }
}
