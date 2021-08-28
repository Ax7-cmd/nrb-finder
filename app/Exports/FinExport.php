<?php

namespace App\Exports;

use App\Models\Nrb;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FinExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $filters;
    protected $selectarea;
    protected $datefrom;
    protected $dateto;
    protected $checksudah;
    protected $checkbelum;

    public function __construct($search, $filters, $selectarea, $dateto, $datefrom, $checkbelum, $checksudah)
    {
        $this->search = $search;
        $this->filters = $filters;
        $this->selectarea = $selectarea;
        $this->datefrom = $datefrom;
        $this->dateto = $dateto;
        $this->checksudah = $checksudah;
        $this->checkbelum = $checkbelum;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $fin = new Nrb;
        $fin = $fin->select('nrb.tgl_retur AS tgl_retur', 'nrb.no_faktur AS no_nrb', 'nrb.no_draf_retur AS no_draft', 'nrb.branch AS branch',
            'nrb.dir AS dir', 'nrb.amount AS amount', 'trps.tgl_tarik AS tgl_tarik', 'trps.driver AS driver',
            'whs.no_ttrs AS no_ttrs', 'whs.tgl_ttrs AS tgl_ttrs', 'rma.no_rma_oracle AS no_rma', 'rma.tgl_rma AS tgl_rma',
            'accs.no_cn AS no_cn', 'accs.tgl_cn AS tgl_cn');
        $fin = $fin->leftjoin('trps', 'nrb.no_faktur', '=', 'trps.no_faktur');
        $fin = $fin->leftjoin('whs', 'nrb.no_faktur', '=', 'whs.no_faktur');
        $fin = $fin->leftjoin('rma', 'nrb.no_faktur', '=', 'rma.rr_no');
        $fin = $fin->leftjoin('accs', 'nrb.no_faktur', '=', 'accs.no_rr');
        if ($this->search != '') {
            $fin = $fin->where('no_faktur', 'like', '%' . $this->search . '%')
                ->orWhere('no_draf_retur', 'like', '%' . $this->search . '%');
        }
        if ($this->filters) {
            $fin = $fin->where('nrb.branch', 'like', '%' . $this->selectarea . '%');
            if ($this->datefrom != "" || $this->dateto != "") {
                $from = date($this->datefrom);
                $to = date($this->dateto);
                $fin = $fin->whereBetween('nrb.tgl_retur', [$from, $to]);
            }

            if ($this->checksudah && !$this->checkbelum) {
                $fin = $fin->whereNotNull('trps.tgl_tarik');
            }
            if ($this->checkbelum && !$this->checksudah) {
                $fin = $fin->whereNull('trps.tgl_tarik');
            }
        }
        $fin = $fin->orderBy('nrb.id')->get();
        return $fin;
    }

    public function headings(): array
    {
        return ["tgl_retur", "no_nrb", "no_draft", "branch", "dir", "amount", "tgl_tarik","driver","no_ttrs","tgl_ttrs","no_rma","tgl_rma","no_cn","tgl_cn"];
    }
}
