<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acc extends Model
{
    use HasFactory;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_rma_oracle',
        'no_cn',
        'tgl_cn',
        'rr_no',
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
