<?php

namespace App\Imports;

use App\Models\Rma;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RmaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $rma = Rma::where('rr_no', $row['rr_no'])->first();
        if (!$rma) {
            $rma = new Rma();
        }
        $rma->rr_no = $row['rr_no'];
        $rma->tgl_rma = $row['tgl_rma'];
        $rma->no_rma_oracle = $row['no_rma_oracle'];
        $rma->amount = $row['amount'];
        $rma->save();
        return $rma;
    }
}
