<?php

namespace App\Http\Controllers\Admin;

use App\Models\TRU;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TRUController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trus = TRU::with('getMPIfromTRU')->get();
        //dd($trus);
        if ($request->ajax()) {
            return Datatables::of($trus)
                ->addIndexColumn()
                ->editColumn('mpi_id', function($tru)
                {
                    return $tru->getMPIfromTRU->shortname;
                })
                ->addColumn('action', function ($tru) {
/*                    $btn = 'Edit';
                    $btn = $btn . ' Delete';
                    return $btn;*/
                    return '
                            <div class="btn-group btn-group-sm px-2" role="group">
                                <a href="javascript:void(0)" class="btn btn-primary"  id="edit-tru" data-id="'.$tru->id.'"><i class="fa fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger delete-tru" id="delete-tru" data-id="'.$tru->id.'"><i class="fa fa-trash"></i></a>
                            </div>
                            ';

                })
                ->rawColumns(['action'])

                ->make(true);
        }

        return view('admin.index_tru', compact('trus'));
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
