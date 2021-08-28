<?php

namespace App\Exports;

use App\Models\Whs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WhsExport implements FromCollection, WithHeadings
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
        $whs = new whs;
        $whs = $whs->select("no_ttrs", "no_faktur",  "tgl_ttrs");
        if($this->search != ''){
            $whs = $whs->where('no_faktur', 'like', '%' . $this->search . '%')
                ->orWhere('no_ttrs', 'like', '%' . $this->search . '%');
        }
        $whs = $whs->orderBy('id')->get();
        return $whs;
    }

    public function headings(): array
    {
        return [ "no_ttrs","no_faktur", "tgl_ttrs"];
    }
}
