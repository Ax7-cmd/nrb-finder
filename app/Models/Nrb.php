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
        'tgl_retur',
        'no_faktur',
        'amount',
        'no_draf_retur',
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
