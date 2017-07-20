<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;

class JurusanController extends Controller
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
            $jurusans = Jurusan::select(['id','name']);
            return Datatables::of($jurusans)
                ->addColumn('action',function($jurusan){
                    return view('datatable._action',[
                        'model'    => $jurusan,
                        'form_url' => route('jurusan.destroy',$jurusan->id),
                        'edit_url' => route('jurusan.edit',$jurusan->id),
                        'confirm_message' => 'Yakin Mau Menghapus '.$jurusan->name . '?'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'id' , 'name' => 'id' ,'title' => 'ID'])
            ->addColumn(['data' => 'name' , 'name' => 'name' ,'title' => 'Nama'])
            ->addColumn(['data' => 'action' , 'name' => 'action' ,'title' => '','orderable'=>false,'searchable'=>false]);

        return view('jurusan.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('jurusan.create');
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
        $this->validate($request,['name' => 'required|unique:jurusans']);
        $jurusan = Jurusan::create($request->only('name'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $jurusan->name "
            ]);
        return redirect()->route('jurusan.index');
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
        $jurusan = Jurusan::find($id);
        return view('jurusan.edit')->with(compact('jurusan'));
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
        $this->validate($request,['name' => 'required|unique:jurusans']);
        $jurusan = Jurusan::find($id);
        $jurusan->update($request->only('name'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $jurusan->name "
            ]);
        return redirect()->route('jurusan.index');
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
        Jurusan::destroy($id);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Jurusan Berhasil Dihapus"
            ]);
        return redirect()->route('jurusan.index');
    }
}
