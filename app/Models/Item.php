<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type_id',
        'brand_id',
        'photos',
        'features',
        'price',
        'star',
        'review'
    ];

    protected $casts = [
        'photos' => 'json',
    ];

    public function getThumbnailAttribute(){
    if ($this->photos) {
        // Pastikan bahwa $this->photos adalah string sebelum menggunakan json_decode
        $photos = is_string($this->photos) ? json_decode($this->photos) : $this->photos;

        return Storage::url($photos[0] ?? 'https://via.placeholder.com/800x600');
    }

    return 'https://via.placeholder.com/800x600';
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
