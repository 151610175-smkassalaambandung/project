<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;
use Illuminate\Support\Facades\File;

class SiswasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        //
        if ($request->ajax()) {
            $siswas = Siswa::with(['kelas','jurusan']);
            return Datatables::of($siswas)
                ->addColumn('foto', function($siswa){
                return '<img src="/img/siswa/'.$siswa->foto.'" height="80px" widht="80px" class="img-circle">';
                })
                ->addColumn('action',function($siswa){
                    return view('datatable._action',[
                        'model'    => $siswa,
                        'form_url' => route('siswa.destroy',$siswa->id),
                        'edit_url' => route('siswa.edit',$siswa->id),
                        'confirm_message' => 'Yakin Mau Menghapus '.$siswa->name . '?'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data'=>'foto','name'=>'foto','title'=>'Foto'])
            ->addColumn(['data' => 'nis' , 'name' => 'nis' ,'title' => 'NIS'])
            ->addColumn(['data' => 'name' , 'name' => 'name' ,'title' => 'Nama'])
            ->addColumn(['data' => 'jeniskelamin' , 'name' => 'jeniskelamin' ,'title' => 'Jenis Kelamin'])
            ->addColumn(['data' => 'kelas.name' , 'name' => 'kelas.name' ,'title' => 'Kelas'])
            ->addColumn(['data' => 'jurusan.name' , 'name' => 'jurusan.name' ,'title' => 'Jurusan'])
            ->addColumn(['data' => 'action' , 'name' => 'action' ,'title' => '','orderable'=>false,'searchable'=>false]);

        return view('siswa.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'nis'   => 'required|numeric|min:6|unique:siswas',
            'name'  => 'required',
            'jeniskelamin'  => 'required',
            'alamat'=> 'required',
            'kelas_id'=>'required|exists:kelas,id',
            'jurusan_id'=>'required|exists:jurusans,id',
            'foto' => 'image|max:2048'
        ]);

        $siswa = Siswa::create($request->except('foto'));

        //isi field foto jika ada foto yang diupload
        if ($request->hasFile('foto')) {
            //mengambil file yang diupload
            $uploaded_foto = $request->file('foto');

            //mengambil extension file
            $extension = $uploaded_foto->getClientOriginalExtension();

            //membuat nama file random berikut extension
            $filename = md5(time()). '.' . $extension;

            //menyimpan foto ke folder public/img
            $destinationPath = public_path().DIRECTORY_SEPARATOR.'/img/siswa';
            $uploaded_foto->move($destinationPath,$filename);

            //mengisi field foto di siswa dengan filename yang baru dibuat
            $siswa->foto = $filename;
            $siswa->save();
        }

        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Berhasil menyimpan $siswa->name"
            ]);
        return redirect()->route('siswa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $siswa = Siswa::find($id);
        return view('siswa.edit')->with(compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'nis'   => 'required|numeric|min:6|unique:siswas',
            'name'  => 'required',
            'jeniskelamin'  => 'required',
            'alamat'=> 'required',
            'kelas_id'=>'required|exists:kelas,id',
            'jurusan_id'=>'required|exists:jurusans,id',
            'foto' => 'image|max:2048'
        ]);

        $siswa = Siswa::find($id);
        $siswa->update($request->all());

        //
        if ($request->hasFile('foto')) {
            //
            $filename = null;
            $uploaded_foto = $request->file('foto');
            $extension = $uploaded_foto->getClientOriginalExtension();

            //
            $filename = md5(time()). '.' . $extension;
            $destinationPath = public_path().DIRECTORY_SEPARATOR.'/img/siswa';

            $uploaded_foto->move($destinationPath,$filename);

            //
            if ($siswa->foto) {
                $old_foto = $siswa->foto;
                $filpath = public_path().DIRECTORY_SEPARATOR.'/img/siswa'.DIRECTORY_SEPARATOR.$siswa->foto;

                try{
                    File::delete($filpath);
                } catch(FileNotFoundException $e) {
                    //
                }
            }
            $siswa->foto = $filename;
            $siswa->save();
        }

        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Berhasil menyimpan $siswa->name"
            ]);
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $siswa = Siswa::find($id);

        //
        if ($siswa->foto) {
                $old_foto = $siswa->foto;
                $filpath = public_path().DIRECTORY_SEPARATOR.'/img/siswa'.DIRECTORY_SEPARATOR.$siswa->foto;

                try{
                    File::delete($filpath);
                } catch(FileNotFoundException $e) {
                    //
                }
            }
            $siswa->delete();
        

        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Siswa berhasil dihapus"
            ]);
        return redirect()->route('siswa.index');

    }
}
