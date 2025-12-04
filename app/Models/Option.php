<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    protected $table = 'options';

    protected $fillable = [
        'product_id',
        'type',
        'name',
        'effect',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function details()
    {
        return $this->hasMany(OptionDetail::class, 'option_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(OptionMessage::class, 'option_id', 'id');
    }


}
