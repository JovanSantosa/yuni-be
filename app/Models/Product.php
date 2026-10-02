<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'condition',
        'stock',
        'is_featured',
        'is_active',
        'branch',
        'wa_message_template',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Product $model) {
            if (empty($model->slug)) {
                $slug = Str::slug($model->name);
                $count = static::withTrashed()->where('slug', $slug)->count();
                $model->slug = $count > 0 ? "{$slug}-" . ($count + 1) : $slug;
            }
        });
    }

    // ── Relationships ──

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    // ── Accessors ──

    protected function stockStatus(): Attribute
    {
        return Attribute::make(
            get: function () {
                $lowThreshold = (int) Setting::get('low_stock_threshold', 3);

                if ($this->stock <= 0) {
                    return 'Stok Habis';
                }
                if ($this->stock <= $lowThreshold) {
                    return 'Stok Menipis';
                }

                return 'Tersedia';
            },
        );
    }

    protected function metaTitleResolved(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->meta_title ?: $this->name,
        );
    }

    protected function metaDescriptionResolved(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->meta_description
                ?: Str::limit(strip_tags($this->description ?? ''), 150),
        );
    }
}
