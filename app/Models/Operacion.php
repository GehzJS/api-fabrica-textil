<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
  protected $table = 'operaciones';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'nombre',
        'precio',
        'maquina',
        'necesario',
        'color',
        'descripcion',
        'modelo_id',
        'tela_id'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  public function nominaItems() 
  {
    return $this->hasMany(NominaItem::class);
  }
  
  public function modelo()
  {
    return $this->belongsTo(Modelo::class);
  }

  public function tela()
  {
    return $this->belongsTo(Tela::class);
  }
}
?>