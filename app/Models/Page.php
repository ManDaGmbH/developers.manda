<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model implements Auditable {

    use \OwenIt\Auditing\Auditable,
        SoftDeletes;

    protected $guarded = [];

    use HasFactory;

    public function pageDetails() {
        return $this->hasMany(PageDetail::class)->orderBy('sort_order');
    }

    protected static function boot() {
        parent::boot();

        static::deleted(function ($invoice) {
            $invoice->pageDetails()->delete();
        });
    }

}
