<?php

namespace App\Http\Controllers\Admin;

use App\Models\TRU;
use App\Models\MPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TRUController extends Controller
{

    public function index(Request $request)
    {
        $trus = TRU::with('getMPIfromTRU')->get();
        $mpis = MPI::all();

        //dd($trus);
        if ($request->ajax()) {
            return Datatables::of($trus)
                ->addIndexColumn()
                // добавление связанной таблицы:
                ->editColumn('mpi_id', function($tru) {
                    return $tru->getMPIfromTRU->shortname;
                })
                ->addColumn('action', function ($tru) {
                    // добавление кнопок с edit и delete, а также data-id для определения id:
                    $btngroup = '
                        <div class="btn-group btn-group-sm px-2" role="group">
                            <a href="javascript:void(0)" class="btn btn-primary" id="edit-tru" data-id="'.$tru->id.'"><i class="fa fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger delete-tru" id="delete-tru" data-id="'.$tru->id.'"><i class="fa fa-trash"></i></a>
                        </div>
                    ';
                    return $btngroup;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.index_tru', compact('trus', 'mpis'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        TRU::updateOrCreate(
                ['id' => $request->tru_id],
                ['name' => $request->name, 'mpi_id' => $request->mpi_id]
            );
        $response = [
            'success' => true,
            'message' => 'TRU saved successfully.',
        ];
        return response()->json($response, 200);

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tru = TRU::find($id);
        return response()->json($tru);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        //$tru->delete();
        if(TRU::destroy($id)) {

        // return response
        $response = [
            'success' => true,
            'message' => 'TRU deleted successfully.',
        ];
            return response()->json($response, 200);
        }
    }
}
