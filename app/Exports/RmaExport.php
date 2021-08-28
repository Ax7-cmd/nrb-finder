<?php

namespace App\Exports;

use App\Models\Rma;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RmaExport implements FromCollection, WithHeadings
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
        $rma = new Rma;
        $rma = $rma->select("rr_no", "tgl_rma", "no_rma_oracle", "created_at");
        if($this->search != ''){
            $rma = $rma->where('rr_no', 'like', '%' . $this->search . '%')
                ->orWhere('no_rma_oracle', 'like', '%' . $this->search . '%');
        }
        $rma = $rma->orderBy('id')->get();
        return $rma;
    }

    public function headings(): array
    {
        return ["rr_no", "tgl_rma", "no_rma_oracle", "created_at"];
    }
}
