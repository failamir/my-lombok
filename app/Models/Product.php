<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'products';

    protected $appends = [
        'photo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CONDITION_RADIO = [
        'new'    => 'new',
        'second' => 'second',
    ];

    public const PRE_ORDER_SELECT = [
        'active'    => 'active',
        'nonactive' => 'nonactive',
    ];

    public const INSURANCE_RADIO = [
        'optional' => 'optional',
        'required' => 'required',
    ];

    public const STATUS_PRODUCT_RADIO = [
        'active'    => 'active',
        'nonactive' => 'nonactive',
    ];

    protected $fillable = [
        'name',
        'etalase_id',
        'condition',
        'description',
        'price',
        'video_product',
        'status_product',
        'stock',
        'sku',
        'minimum_order',
        'unit_price',
        'wholesale_price',
        'weight',
        'long',
        'width',
        'height',
        'insurance',
        'pre_order',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function etalase()
    {
        return $this->belongsTo(Etalase::class, 'etalase_id');
    }

    public function tags()
    {
        return $this->belongsToMany(ProductTag::class);
    }

    public function getPhotoAttribute()
    {
        $files = $this->getMedia('photo');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }
}
