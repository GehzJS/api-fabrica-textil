<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
  protected $table = 'empleados';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'foto',
        'nombre',
        'apellido_p',
        'apellido_m',
        'correo',
        'telefono',
        'cargo',
        'es_usuario'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  public function usuario()
  {
    return $this->hasOne(Usuario::class);
  }
  public function nominas()
  {
    return $this->hasMany(Nomina::class);
  }
  public function defectos()
  {
    return $this->hasMany(Defecto::class);
  }
}
?>