<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adquisicion extends Model
{
  protected $table = 'adquisiciones';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'proveedor_id',
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
    return $this->hasMany(AdquisicionItem::class);
  }

  public function proveedor()
  {
    return $this->belongsTo(Proveedor::class);
  }
}
?>