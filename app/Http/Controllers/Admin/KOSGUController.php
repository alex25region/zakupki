<?php

namespace App\Http\Controllers\Admin;

use App\Models\KODRashodov;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KOSGU;
use DataTables;

class KOSGUController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $kosgus = KOSGU::with('getKODrashodov')->get();
//        return view('admin.index_kosgu', compact('kosgus'));

        $kosgus = KOSGU::with('getKODrashodov')->get();
        $kodrashodov = KODRashodov::all();

        if ($request->ajax()) {
            return Datatables::of($kosgus)
                ->addIndexColumn()
                // добавление связанной таблицы:
                ->editColumn('kod_rashodov_id', function($kosgu) {
                    return $kosgu->getKODrashodov->kod;
                })
                ->addColumn('action', function ($kosgu) {
                    // добавление кнопок с edit и delete, а также data-id для определения id:
                    $btngroup = '
                        <div class="btn-group btn-group-sm px-2" role="group">
                            <a href="javascript:void(0)" class="btn btn-primary" id="edit-kosgu" data-id="'.$kosgu->id.'"><i class="fa fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger delete-kosgu" id="delete-kosgu" data-id="'.$kosgu->id.'"><i class="fa fa-trash"></i></a>
                        </div>
                    ';
                    return $btngroup;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.index_kosgu', compact('kosgus', 'kodrashodov'));




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
        KOSGU::updateOrCreate(
            ['id' => $request->kosgu_id],
            [
                'kod_rashodov_id' => $request->kod_rashodov_id,
                'kod' => $request->kod,
                'name' => $request->name,
            ]
        );
        $response = [
            'success' => true,
            'message' => 'KOSGU saved successfully.',
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
        $kosgu = KOSGU::find($id);
        return response()->json($kosgu);
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
        if(KOSGU::destroy($id)) {

            // return response
            $response = [
                'success' => true,
                'message' => 'KOSGU deleted successfully.',
            ];
            return response()->json($response, 200);
        }
    }
}
