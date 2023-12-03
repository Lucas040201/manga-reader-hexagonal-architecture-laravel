<?php

namespace App\Models;

class PasswordRecoveryRequest extends BaseModel
{
    protected $table = 'tb_password_recovery_request';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'token',
        'expiration',
        'used',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
    ];
}
