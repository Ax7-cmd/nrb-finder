<?php

namespace App\Exports;

use App\Models\Acc;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AccExport implements FromCollection, WithHeadings
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
        $acc = new Acc;
        $acc = $acc->select("no_rma_oracle","no_cn","tgl_cn","no_rr",  "amount",  "created_at");
        if($this->search != ''){
            $acc = $acc->where('no_rma_oracle', 'like', '%' . $this->search . '%')
                ->orWhere('no_cn', 'like', '%' . $this->search . '%');
        }
        $acc = $acc->orderBy('id')->get();
        return $acc;
    }

    public function headings(): array
    {
        return ["no_rma_oracle","no_cn","tgl_cn","no_rr",  "amount",  "created_at"];
    }
}
