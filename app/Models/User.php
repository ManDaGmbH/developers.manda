<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Auditable {

    use \OwenIt\Auditing\Auditable, SoftDeletes;
    use HasFactory,
        Notifiable,
        HasRoles;

    protected $fillable = [
        'password',
        'reset_token',
        'reset_token_expiry',
        'first_name',
        'last_name',
        'email',
        'status',
        'phone1',
        'phone2',
        'address1',
        'address2',
        'city',
        'state',
        'zip'];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function ModelHasRoles() {
        return $this->hasMany('App\Models\ModelHasRole','model_id', 'id');
    }

}
