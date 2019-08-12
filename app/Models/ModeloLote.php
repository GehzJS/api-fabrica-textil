<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeloLote extends Model
{
  protected $table = 'modelos_lotes';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'cantidad',
        'descripcion',
        'modelo_id'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  public function modelo()
  {
    return $this->belongsTo(Modelo::class);
  }
}
?>