<?php

namespace App\Exports;

use App\Models\Trp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrpExport implements FromCollection, WithHeadings
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
        $trp = new trp;
        $trp = $trp->select("no_faktur", "no_draf_retur","branch","dir","driver","tgl_tarik", "created_at");
        if($this->search != ''){
            $trp = $trp->where('no_faktur', 'like', '%' . $this->search . '%')
                ->orWhere('no_draf_retur', 'like', '%' . $this->search . '%');
        }
        $trp = $trp->orderBy('id')->get();
        return $trp;
    }

    public function headings(): array
    {
        return ["no_faktur", "no_draf_retur","branch","dir","driver","tgl_tarik", "created_at"];
    }
}
