<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whs extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'whs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_ttrs',
        'no_faktur',
        'tgl_ttrs',
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
