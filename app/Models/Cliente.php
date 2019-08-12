<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $table = 'clientes';
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

  public function ventas()
  {
    return $this->hasMany(Venta::class);
  }
}
?>