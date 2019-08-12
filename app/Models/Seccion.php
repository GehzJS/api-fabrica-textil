<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
  protected $table = 'secciones';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'nombre'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  // public function modelo()
  // {
  //   return $this->belongsTo(Modelo::class);
  // }
}
?>