<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use SoftDeletes , InteractsWithMedia  , Searchable;

    /**
     * The attributes that are mass assignable.
     * Only allow safe columns for API requests.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_base',
        'discount_percentage',
        'unit',
        'minimum',
        'quantity',
        'maximum',
        'preparation_time',
        'available',
        'rate',
        'batch_code',
        'matin_code',
        'category_id',
    ];

    protected $with = ['feedbacks'];

    protected $hidden = [
        'deleted_at',
    ];


    protected $casts = [
        'price_base' => 'decimal:2',
        'discount_percentage' => 'integer',
        'minimum' => 'integer',
        'maximum' => 'integer',
        'preparation_time' => 'integer',
        'available' => 'boolean',
        'rate' => 'decimal:2',
    ];

    public function options()
    {
        return $this->belongsToMany(Option::class)
            ->withPivot('detail_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->useDisk('public');
    }


    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * Scope for active products
     */
    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }

    /**
     * Calculate discounted price
     */
    public function getPriceAttribute()
    {
        if ($this->discount_percentage > 0) {
            return round($this->price_base * (1 - $this->discount_percentage / 100), 2);
        }
        return $this->price_base;
    }

    /**
     * The data I want to include in the search
     */
    public function toSearchableArray(): array
    {
        return [
            'name'        => $this->name,
            'description' => $this->description ?? '',
            'slug'         => $this->slug ?? '',
        ];
    }

}
