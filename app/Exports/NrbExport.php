<?php

namespace App\Exports;

use App\Models\Nrb;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NrbExport implements FromCollection, WithHeadings
{
    protected $search;

    function __construct($search) {
            $this->search = $search;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $nrb = new Nrb;
        $nrb = $nrb->select("no_faktur","no_draf_retur","tgl_retur","branch","dir",  "amount",  "created_at");
        if($this->search != ''){
            $nrb = $nrb->where('no_faktur', 'like', '%' . $this->search . '%')
                ->orWhere('no_draf_retur', 'like', '%' . $this->search . '%');
        }
        $nrb = $nrb->orderBy('id')->get();
        return $nrb;
    }

    public function headings(): array
    {
        return ["no_faktur","no_draf_retur","tgl_retur","branch","dir",  "amount",  "created_at"];
    }
}
