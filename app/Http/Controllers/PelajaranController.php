<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelajaran;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;

class PelajaranController extends Controller
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
            $pelajarans = Pelajaran::select(['id','name']);
            return Datatables::of($pelajarans)
                ->addColumn('action',function($pelajaran){
                    return view('datatable._action',[
                        'model'    => $pelajaran,
                        'form_url' => route('pelajaran.destroy',$pelajaran->id),
                        'edit_url' => route('pelajaran.edit',$pelajaran->id),
                        'confirm_message' => 'Yakin Mau Menghapus '.$pelajaran->name . '?'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'name' , 'name' => 'name' ,'title' => 'Nama'])
            ->addColumn(['data' => 'action' , 'name' => 'action' ,'title' => '','orderable'=>false,'searchable'=>false]);

        return view('pelajaran.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pelajaran.create');
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
        $this->validate($request,['name' => 'required|unique:pelajarans']);
        $pelajaran = Pelajaran::create($request->only('name'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $pelajaran->name "
            ]);
        return redirect()->route('pelajaran.index');
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
        $pelajaran = Pelajaran::find($id);
        return view('pelajaran.edit')->with(compact('pelajaran'));
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
        $this->validate($request,['name' => 'required|unique:pelajarans']);
        $pelajaran = Pelajaran::find($id);
        $pelajaran->update($request->only('name'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $pelajaran->name "
            ]);
        return redirect()->route('pelajaran.index');
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
        Pelajaran::destroy($id);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Pelajaran Berhasil Dihapus"
            ]);
        return redirect()->route('pelajaran.index');
    }
}
