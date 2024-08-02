<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model implements Auditable {

    use \OwenIt\Auditing\Auditable,
        SoftDeletes,
        HasFactory;

    protected $guarded = [];

}
