<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OBAS;
use Illuminate\Support\Facades\DB;

class OBASController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obas = OBAS::with('getMPI:id,shortname,kod', 'getTRU:id,name', 'getKOSGU:id,kod,name', 'getOKPD:id,kod,name')
            //->take(10)
            ->get()
            ->sortBy( 'mpi_id');

        //$obas = OBAS::all();
        dd($obas);

// почему то не пашет!
//        $obas = DB::table('z_obas')
//            ->join('z_mpi',     'z_mpi.id',     '=',    'z_obas.mpi_id')
//            ->join('z_tru',     'z_tru.id',     '=',    'z_obas.tru_id')
//            ->join('z_kosgu',   'z_kosgu.id',   '=',    'z_obas.kosgu_id')
//            ->join('z_okpd',    'z_okpd.id',    '=',    'z_obas.okpd_id')
//            ->select('z_obas.year, z_mpi.shortname, z_mpi.kod, z_tru.name, z_kosgu.kod, z_kosgu.name, z_okpd.kod, z_okpd.name')
//            ->get();

        dd($obas);

        //return view('');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
}
