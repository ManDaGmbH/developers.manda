<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements Auditable {

    use \OwenIt\Auditing\Auditable,
        SoftDeletes;

    protected $guarded = [];

    public function images() {
        return $this->hasMany(CategoryGallery::class)->orderBy('sort_order');
    }

    protected static function boot() {
        parent::boot();

        static::deleted(function ($invoice) {
            $invoice->images()->delete();
        });
    }

}
