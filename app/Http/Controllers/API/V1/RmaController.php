<?php

namespace App\Http\Controllers\API\V1;

use App\Exports\RmaExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rma\RmaImportRequest;
use App\Imports\RmaImport;
use App\Models\Rma;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RmaController extends BaseController
{
    protected $rma = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Rma $rma)
    {
        $this->middleware('auth:api')->except('index', 'export');
        $this->rma = $rma;
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
        $rma = new Rma;

        if($search != '' && $search != null){
            $rma = $rma->where('rr_no', 'like', '%' . $search . '%')
                ->orWhere('no_rma_oracle', 'like', '%' . $search . '%');
        }
        $total = $rma;
        $total = $total->count();
        if($skip > 0){
            $rma = $rma->skip($skip);
        }
        if($skip+$take < $total){
            $more = true;
        }
        if($take > 0){
            $rma = $rma->take($take);
        }
        $rma = $rma->orderBy('id', 'asc')->get();
        return $this->sendResponse($rma, [
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
    public function store(RmaImportRequest $request)
    {
        Excel::import(new RmaImport, $request->file('file'));
        return $this->sendResponse([], 'Import Rma Successfully');
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
        return Excel::download(new RmaExport($search), 'rma-export_' . date('Y-m-d H:i:s') . '.xlsx');
    }
}
