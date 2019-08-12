<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
  protected $table = 'maquinas';
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