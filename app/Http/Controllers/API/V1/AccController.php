<?php

namespace App\Http\Controllers\API\V1;

use App\Exports\AccExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Acc\AccImportRequest;
use App\Imports\AccImport;
use App\Models\Acc;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AccController extends BaseController
{
    protected $acc = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Acc $acc)
    {
        $this->middleware('auth:api')->except('index', 'export');
        $this->acc = $acc;
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
        $acc = new Acc;

        if($search != '' && $search != null){
            $acc = $acc->where('rr_no', 'like', '%' . $search . '%')
                ->orWhere('no_Acc_oracle', 'like', '%' . $search . '%');
        }
        $total = $acc;
        $total = $total->count();
        if($skip > 0){
            $acc = $acc->skip($skip);
        }
        if($skip+$take < $total){
            $more = true;
        }
        if($take > 0){
            $acc = $acc->take($take);
        }
        $acc = $acc->orderBy('id', 'asc')->get();
        return $this->sendResponse($acc, [
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
    public function store(AccImportRequest $request)
    {
        Excel::import(new AccImport, $request->file('file'));
        return $this->sendResponse([], 'Import Acc Successfully');
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
        return Excel::download(new AccExport($search), 'acc-export_' . date('Y-m-d H:i:s') . '.xlsx');
    }
}
