<?php

namespace Interns2024c\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
* @property string $name
* @property string $email
* @property string $password
* @property Carbon $email_verified_at
* @property Carbon $created_at
* @property Carbon $updated_at
* @property int $id
*/
class User extends Authenticatable
{
use HasApiTokens, HasFactory, Notifiable;


protected $fillable = [
'name',
'email',
'password',
];

protected $hidden = [
'password',
'remember_token',
];

protected $casts = [
'email_verified_at' => 'datetime',
'password' => 'hashed',
];

/**
* Custom create method to handle user creation
*
* @param array $attributes
* @return static
*/
public static function create(array $attributes): static
{
$attributes['password'] = bcrypt($attributes['password']);
return static::query()->create($attributes);
}
}
