<?php

namespace App\Imports;

use App\Models\Acc;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AccImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $acc = Acc::where('no_cn', $row['no_cn'])->first();
        if (!$acc) {
            $acc = new Acc();
        }
        $acc->no_rma_oracle = $row['no_rma_oracle'];
        $acc->no_cn = $row['no_cn'];
        $acc->tgl_cn = $row['tgl_cn'];
        $acc->no_rr = $row['no_rr'];
        $acc->amount = $row['amount'];
        $acc->save();
        return $acc;
    }
}
