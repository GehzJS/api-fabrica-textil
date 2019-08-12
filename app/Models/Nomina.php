<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
  protected $table = 'nominas';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'empleado_id',
        'descripcion',
        'total',
        'estado'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  public function items()
  {
    return $this->hasMany(NominaItem::class);
  }

  public function empleado()
  {
    return $this->belongsTo(Empleado::class);
  }
}
?>