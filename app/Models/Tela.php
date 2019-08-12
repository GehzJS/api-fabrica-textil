<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tela extends Model
{
  protected $table = 'telas';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'nombre',
        'color',
        'caracteristicas',
        'seccion',
        'stock',
        'precio'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  public function operaciones()
  {
    return $this->hasMany(Operacion::class);
  }
  public function adquisicionItems() 
  {
    return $this->hasMany(AdquisicionItem::class);
  }
}
?>