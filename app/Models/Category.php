<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'description',
        'is_active',
        'sort_order',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Parent category relation (self-referencing)
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Children categories relation (self-referencing)
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Scope to get only active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Recursive method to get all descendants
     */
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    /**
     * Helper to check if category is root
     */
    public function isRoot(): bool
    {
        return is_null($this->parent_id);
    }
}
