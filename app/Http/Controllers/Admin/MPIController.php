<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Models\MPI;
use DataTables;

class MPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //default
//        $mpis = MPI::all()->sortBy('shortname')->sortBy('year');
//        return view('admin.index_mpi', compact('mpis'));

        $mpis = MPI::all()->sortBy('shortname')->sortBy('year');
        if ($request->ajax()) {
            return Datatables::of($mpis)
                ->addIndexColumn()
                // добавление связанной таблицы:

                ->addColumn('action', function ($mpi) {
                    // добавление кнопок с edit и delete, а также data-id для определения id:
                    $btngroup = '
                        <div class="btn-group btn-group-sm px-2" role="group">
                            <a href="javascript:void(0)" class="btn btn-primary" id="edit-mpi" data-id="' . $mpi->id . '"><i class="fa fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger" id="delete-mpi" data-id="' . $mpi->id . '"><i class="fa fa-trash"></i></a>
                        </div>
                    ';
                    return $btngroup;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.index_mpi', compact('mpis'));


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
        MPI::updateOrCreate(
            ['id' => $request->id],
            ['year' => $request->year, 'shortname' => $request->shortname, 'name' => $request->name, 'kod' => $request->kod]
        );
//        return Response::json($mpi);
        $response = [
            'success' => true,
            'message' => 'MPI saved successfully.',
        ];
        return response()->json($response, 200);
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
        $where = array('id' => $id);
        $mpi  = MPI::where($where)->first();

        return Response::json($mpi);
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
        // почему в debug показывает 2 запроса - 1. Select 2. Delete
        // $mpi = MPI::destroy($id);

        // в debug показывает 1 запроса - 1. Delete
        $mpi = MPI::where('id',$id)->delete();

        return Response::json($mpi);
    }
}
