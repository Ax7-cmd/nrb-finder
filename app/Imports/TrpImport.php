<?php

namespace App\Imports;

use App\Models\Trp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TrpImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $trp = Trp::where('no_faktur', $row['no_faktur'])->first();
        if (!$trp) {
            $trp = new Trp();
        }
        $trp->no_faktur = $row['no_faktur'];
        $trp->no_draf_retur = $row['no_draf_retur'];
        $trp->branch = $row['branch'];
        $trp->dir = $row['dir'];
        $trp->driver = $row['driver'];
        $trp->tgl_tarik = $row['tgl_tarik'];
        $trp->save();
        return $trp;
    }
}
