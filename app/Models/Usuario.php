<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Usuario extends Model implements AuthenticatableContract, AuthorizableContract
{
  use HasApiTokens, Authenticatable, Authorizable;

  protected $table = 'usuarios';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'avatar',
    'usuario',
    'contrasena',
    'rol',
    'empleado_id',
    'api_token'
  ];

  /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
  protected $hidden = [
    'contrasena',
  ];

  public function findForPassport($username) {
    return self::where('usuario', $username)->first();
  }

  public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->contrasena);
    }

  public function empleado()
  {
    return $this->belongsTo(Empleado::class);
  }
}
