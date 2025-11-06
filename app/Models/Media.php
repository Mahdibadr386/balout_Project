<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'model_id',
        'model_type',
        'type',
        'collection_name',
        'file_name',
        'disk',
        'path',
        'url',
        'size',
        'duration',
        'custom_properties',
        'order_column',
    ];

    /**
     * Casts for proper types
     */
    protected $casts = [
        'model_id' => 'integer',
        'size' => 'integer',
        'duration' => 'integer',
        'order_column' => 'integer',
        'custom_properties' => 'array', // automatically converts JSON to array
    ];

    protected $attributes = [
        'custom_properties' => [], // default empty array
    ];

    /**
     * Polymorphic relation
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Scope to filter only images
     */
    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    /**
     * Scope to filter only videos
     */
    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }
}
