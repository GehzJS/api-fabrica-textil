<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
  protected $table = 'ventas';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'cliente_id',
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
    return $this->hasMany(VentaItem::class);
  }

  public function cliente()
  {
    return $this->belongsTo(Cliente::class);
  }
}
?>