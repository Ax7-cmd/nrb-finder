<?php

namespace App\Http\Controllers\API\V1;

use App\Exports\TrpExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trp\TrpImportRequest;
use App\Imports\TrpImport;
use App\Models\Trp;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TrpController extends BaseController
{
    protected $trp = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(trp $trp)
    {
        $this->middleware('auth:api')->except('index', 'export');
        $this->Trp = $trp;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skip = (int)$request->skip;
        $take = (int)$request->take;
        $search = $request->search;
        $more = false;
        $trp = new Trp;

        if($search != '' && $search != null){
            $trp = $trp->where('no_faktur', 'like', '%' . $search . '%')
                ->orWhere('no_draf_retur', 'like', '%' . $search . '%');
        }
        $total = $trp;
        $total = $total->count();
        if($skip > 0){
            $trp = $trp->skip($skip);
        }
        if($skip+$take < $total){
            $more = true;
        }
        if($take > 0){
            $trp = $trp->take($take);
        }
        $trp = $trp->orderBy('id', 'asc')->get();
        return $this->sendResponse($trp, [
            'more' => $more,
            'skip' => $skip,
            'take' => $take,
            'search' => $search,
        ]);
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
    public function store(TrpImportRequest $request)
    {
        Excel::import(new TrpImport, $request->file('file'));
        return $this->sendResponse([], 'Import Trp Successfully');
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

    public function export(Request $request)
    {
        $search = $request->search;
        if($search == null || $search == 'null'){
            $search = '';
        }
        return Excel::download(new TrpExport($search), 'trp-export_' . date('Y-m-d H:i:s') . '.xlsx');
    }
}
