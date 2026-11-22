<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'full_name',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
    ];

    // Your original database has created_at only.
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = null;

    public $timestamps = true;
}
