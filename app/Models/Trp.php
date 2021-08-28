<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trp extends Model
{
    use HasFactory;

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_faktur',
        'no_draf_retur',
        'branch',
        'dir',
        'driver',
        'tgl_tarik',
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
