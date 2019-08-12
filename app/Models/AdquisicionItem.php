<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdquisicionItem extends Model
{
  protected $table = 'adquisiciones_items';
  /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'cantidad',
        'precio',
        'tela',
        'adquisicion_id',
        'tela_id'
    ];

  /**
    * The attributes excluded from the model's JSON form.
    * @var array
    */
  protected $hidden = [

  ];

  public function adquisicion()
  {
    return $this->belongsTo(Adquisicion::class);
  }

  public function tela()
  {
    return $this->belongsTo(Tela::class);
  }
}
?>