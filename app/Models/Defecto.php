<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Defecto extends Model
{
  protected $table = 'defectos';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'cantidad',
        'descripcion',
        'empleado_id',
        'modelo_id'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  public function empleado()
  {
    return $this->belongsTo(Empleado::class);
  }

  public function modelo()
  {
    return $this->belongsTo(Modelo::class);
  }
}
?>