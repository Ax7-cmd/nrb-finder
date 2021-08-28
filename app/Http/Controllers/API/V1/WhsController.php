<?php

namespace App\Http\Controllers\API\V1;

use App\Exports\WhsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Whs\WhsImportRequest;
use App\Imports\WhsImport;
use App\Models\Whs;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WhsController extends BaseController
{
    protected $whs = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Whs $whs)
    {
        $this->middleware('auth:api')->except('index', 'export');
        $this->whs = $whs;
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
        $whs = new Whs;

        if($search != '' && $search != null){
            $whs = $whs->where('no_faktur', 'like', '%' . $search . '%')
                ->orWhere('no_ttrs', 'like', '%' . $search . '%');
        }
        $total = $whs;
        $total = $total->count();
        if($skip > 0){
            $whs = $whs->skip($skip);
        }
        if($skip+$take < $total){
            $more = true;
        }
        if($take > 0){
            $whs = $whs->take($take);
        }
        $whs = $whs->orderBy('id', 'asc')->get();
        return $this->sendResponse($whs, [
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
    public function store(WhsImportRequest $request)
    {
        Excel::import(new WhsImport, $request->file('file'));
        return $this->sendResponse([], 'Import Whs Successfully');
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
        return Excel::download(new WhsExport($search), 'whs-export_' . date('Y-m-d H:i:s') . '.xlsx');
    }
}
