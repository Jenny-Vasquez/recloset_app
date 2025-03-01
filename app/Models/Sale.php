<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Sale extends Model
{
    //
    protected $fillable = ['product', 'description', 'price','img', 'category_id', 'user_id', 'buyerId', 'isSold'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'sale_id');
    }
}
