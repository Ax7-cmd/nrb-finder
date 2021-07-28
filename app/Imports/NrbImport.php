<?php

namespace App\Imports;

use App\Models\Nrb;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NrbImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $nrb = Nrb::where('no_faktur', $row['no_faktur'])->first();
        if (!$nrb) {
            $nrb = new Nrb();
        }
        $nrb->tgl_retur = $row['tgl_retur'];
        $nrb->no_faktur = $row['no_faktur'];
        $nrb->amount = $row['amount'];
        $nrb->no_draf_retur = $row['no_draf_retur'];
        $nrb->save();
        return $nrb;
    }
}
