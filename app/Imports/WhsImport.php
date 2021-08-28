<?php

namespace App\Imports;

use App\Models\Whs;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WhsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $whs = Whs::where('no_ttrs', $row['no_ttrs'])->first();
        if (!$whs) {
            $whs = new Whs();
        }
        $whs->no_ttrs = $row['no_ttrs'];
        $whs->no_faktur = $row['no_faktur'];
        $whs->tgl_ttrs = $row['tgl_ttrs'];
        $whs->save();
        return $whs;
    }
}
