<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    const PUBLIC_PROD_IMAGE_FOLDER = 'Pro_Images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'images', // Todo: fix data too long
        'status',
        'sku',
        'supplier_sku',
        'cost',
        'price',
        'category_id',
        'supplier_id',
        'quantity',
        // Todo:: add product type = default = single | multiple & add column sub_product => qty of multiple = default
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
