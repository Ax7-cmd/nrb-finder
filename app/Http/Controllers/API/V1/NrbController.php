<?php

namespace App\Http\Controllers\API\V1;

use App\Exports\NrbExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Nrb\NrbImportRequest;
use App\Imports\NrbImport;
use App\Models\Nrb;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NrbController extends BaseController
{
    protected $nrb = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Nrb $nrb)
    {
        $this->middleware('auth:api')->except('index', 'export');
        $this->nrb = $nrb;
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
        $nrb = new Nrb;

        if($search != '' && $search != null){
            $nrb = $nrb->where('no_faktur', 'like', '%' . $search . '%')
                ->orWhere('no_draf_retur', 'like', '%' . $search . '%');
        }
        $total = $nrb;
        $total = $total->count();
        if($skip > 0){
            $nrb = $nrb->skip($skip);
        }
        if($skip+$take < $total){
            $more = true;
        }
        if($take > 0){
            $nrb = $nrb->take($take);
        }
        $nrb = $nrb->orderBy('id', 'asc')->get();
        return $this->sendResponse($nrb, [
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
    public function store(NrbImportRequest $request)
    {
        Excel::import(new NrbImport, $request->file('file'));
        return $this->sendResponse([], 'Import Nrb Successfully');
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
        return Excel::download(new NrbExport($search), 'nrb-export_' . date('Y-m-d H:i:s') . '.xlsx');
    }
}
