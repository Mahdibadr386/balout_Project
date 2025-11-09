<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionMessage extends Model
{
    use SoftDeletes;

    protected $table = 'option_messages';

    protected $fillable = [
        'id',
        'option_id',
        'text',
    ];

    protected $casts = [
        'option_id' => 'integer',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'id');
    }
}
