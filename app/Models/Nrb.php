<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nrb extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nrb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_faktur',
        'no_draf_retur',
        'tgl_retur',
        'branch',
        'dir',
        'amount',
    ];

    public function getCreatedAtAttribute($date)
    {
        return date("Y-m-d H:i:s", strtotime($date));
    }

    public function getUpdatedAtAttribute($date)
    {
        return date("Y-m-d H:i:s", strtotime($date));
    }
}
