<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionDetail extends Model
{
    use SoftDeletes;

    protected $table = 'option_details';

    protected $fillable = [
        'option_id',
        'name',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'id');
    }
}
