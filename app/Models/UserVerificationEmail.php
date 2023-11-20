<?php

namespace App\Models;

class UserVerificationEmail extends BaseModel
{
    protected $table = 'tb_user_verification_email';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'token',
        'user_id',
        'valid_until',
    ];
}
