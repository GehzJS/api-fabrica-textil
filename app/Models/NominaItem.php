<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NominaItem extends Model
{
  protected $table = 'nominas_items';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'cantidad',
        'precio',
        'operacion',
        'nomina_id',
        'operacion_id'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  public function nomina()
  {
    return $this->belongsTo(Nomina::class);
  }

  public function operacion()
  {
    return $this->belongsTo(Operacion::class);
  }
}
?>