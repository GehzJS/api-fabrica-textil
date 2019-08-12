<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
  protected $table = 'proveedores';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'nombre',
        'apellido_p',
        'apellido_m',
        'correo',
        'telefono'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  public function adquisiciones() 
  {
    return $this->hasMany(Adquisicion::class);
  }
}
?>