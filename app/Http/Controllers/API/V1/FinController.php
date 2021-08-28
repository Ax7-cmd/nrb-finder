<?php

namespace App\Http\Controllers\API\V1;

use App\Exports\FinExport;
use App\Http\Controllers\Controller;
use App\Models\Nrb;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FinController extends BaseController
{
    protected $fin = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Nrb $fin)
    {
        $this->middleware('auth:api')->except('index', 'export');
        $this->fin = $fin;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skip = (int) $request->skip;
        $take = (int) $request->take;
        $search = $request->search;
        $filters = (isset($request->filters) ? ($request->filters == 'true' ? true : false) : false);
        $selectarea = (isset($request->selectarea) ? $request->selectarea : '');
        $datefrom = (isset($request->datefrom) ? $request->datefrom : '');
        $dateto = (isset($request->dateto) ? $request->dateto : '');
        $checkbelum = (isset($request->checkbelum) ? ($request->checkbelum == 'true' ? true : false) : false);
        $checksudah = (isset($request->checksudah) ? ($request->checksudah == 'true' ? true : false) : false);
        $more = false;
        $fin = new Nrb;
        $fin = $fin->select('nrb.tgl_retur AS tgl_retur', 'nrb.no_faktur AS no_nrb', 'nrb.no_draf_retur AS no_draft',
            'nrb.dir AS dir', 'nrb.amount AS amount', 'trps.tgl_tarik AS tgl_tarik', 'trps.driver AS driver',
            'whs.no_ttrs AS no_ttrs', 'whs.tgl_ttrs AS tgl_ttrs', 'rma.no_rma_oracle AS no_rma', 'rma.tgl_rma AS tgl_rma',
            'accs.no_cn AS no_cn', 'accs.tgl_cn AS tgl_cn', 'nrb.branch AS branch');
        $fin = $fin->leftjoin('trps', 'nrb.no_faktur', '=', 'trps.no_faktur');
        $fin = $fin->leftjoin('whs', 'nrb.no_faktur', '=', 'whs.no_faktur');
        $fin = $fin->leftjoin('rma', 'nrb.no_faktur', '=', 'rma.rr_no');
        $fin = $fin->leftjoin('accs', 'nrb.no_faktur', '=', 'accs.no_rr');

        
        if ($filters) {
            $fin = $fin->where('nrb.branch', 'like', '%' . $selectarea . '%');
            if ($datefrom != "" || $dateto != "") {
                $from = date($datefrom);
                $to = date($dateto);
                $fin = $fin->whereBetween('nrb.tgl_retur', [$from, $to]);               
            }
            
            if($checksudah && !$checkbelum){
                $fin = $fin->whereNotNull('trps.tgl_tarik');
            }
            if($checkbelum && !$checksudah){
                $fin = $fin->whereNull('trps.tgl_tarik');
            }
        }
        
        if ($search != '' && $search != null) {
            $fin = $fin->where(function($query) use ($search){
                $query->where('nrb.no_faktur', 'like', '%' . $search . '%')
                ->orWhere('nrb.no_draf_retur', 'like', '%' . $search . '%');
            });
            
        }
        $total = $fin;
        $total = $total->count();
        if ($skip > 0) {
            $fin = $fin->skip($skip);
        }
        if ($skip + $take < $total) {
            $more = true;
        }
        if ($take > 0) {
            $fin = $fin->take($take);
        }
        $fin = $fin->orderBy('nrb.tgl_retur', 'asc')->orderBy('nrb.no_draf_retur', 'asc')->get();
        return $this->sendResponse($fin, [
            'filters' => $filters,
            'selectarea' => $selectarea,
            'datefrom' => $datefrom,
            'dateto' => $dateto,
            'checksudah' => $checksudah,
            'checkbelum' => $checkbelum,
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
    public function store()
    {

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
        $filters = (isset($request->filters) ? ($request->filters == 'true' ? true : false) : false);
        $selectarea = (isset($request->selectarea) ? $request->selectarea : '');
        $datefrom = (isset($request->datefrom) ? $request->datefrom : '');
        $dateto = (isset($request->dateto) ? $request->dateto : '');
        $checkbelum = (isset($request->checkbelum) ? ($request->checkbelum == 'true' ? true : false) : false);
        $checksudah = (isset($request->checksudah) ? ($request->checksudah == 'true' ? true : false) : false);
        $search = $request->search;
        if ($search == null || $search == 'null') {
            $search = '';
        }
        return Excel::download(new FinExport($search, $filters, $selectarea, $dateto, $datefrom, $checkbelum, $checksudah), 'fin-export_' . date('Y-m-d H:i:s') . '.xlsx');
    }
}
