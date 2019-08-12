<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaItem extends Model
{
  protected $table = 'ventas_items';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'cantidad',
        'precio',
        'modelo',
        'venta_id',
        'modelo_id'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  public function venta()
  {
    return $this->belongsTo(Venta::class);
  }

  public function modelo()
  {
    return $this->belongsTo(Modelo::class);
  }
}
?>