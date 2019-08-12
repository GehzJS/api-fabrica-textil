<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
  protected $table = 'modelos';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'imagen',
        'nombre',
        'descripcion',
        'tipo',
        'material',
        'para',
        'talla',
        'stock',
        'precio'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  public function ventaItems() 
  {
    return $this->hasMany(VentaItem::class);
  }

  public function defectos() 
  {
    return $this->hasMany(Defecto::class);
  }

  public function lotes() 
  {
    return $this->hasMany(ModeloLote::class);
  }

  // public function secciones() 
  // {
  //   return $this->hasMany(Seccion::class);
  // }

  // public function tallas() 
  // {
  //   return $this->hasMany(Talla::class);
  // }

  // public function tipos() 
  // {
  //   return $this->hasMany(Tipo::class);
  // }

  public function operaciones() 
  {
    return $this->hasMany(Operacion::class);
  }
}
?>