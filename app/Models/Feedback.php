<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;

    // Fillable fields for mass assignment
    protected $fillable = [
        'product_id',
        'user_id',
        'comment',
        'approved',
        'rate',
    ];

    protected $table = 'feedbacks';
    // Casting for proper data types
    protected $casts = [
        'approved' => 'boolean',
        'rate' => 'integer',
    ];

    /**
     * Relationships
     */

    // Feedback belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Feedback belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scopes
     */

    // Scope for approved feedbacks
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    // Scope for high rating feedbacks
    public function scopeHighRating($query, $min = 4)
    {
        return $query->where('rate', '>=', $min);
    }
}
