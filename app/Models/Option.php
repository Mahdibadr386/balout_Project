<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Option extends Model
{
    use SoftDeletes ,  Searchable;

    protected $table = 'options';

    protected $with = ['details'];

    protected $fillable = [
        'category_id',
        'type',
        'name',
        'effect',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('detail_id');
    }

    public function details()
    {
        return $this->hasMany(OptionDetail::class, 'option_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(OptionMessage::class, 'option_id', 'id');
    }

    public function toSearchableArray(): array
    {
        return [
            'name'        => $this->name ?? '',
        ];
    }
}
