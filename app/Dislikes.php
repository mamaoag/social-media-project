<?php

namespace Tragala;

use Illuminate\Database\Eloquent\Model;

class Dislikes extends Model
{
  protected $fillable = ['user_id'];
  public function dislikeable()
  {
    return $this->morphTo();
  }

  public function user()
  {
    return $this->belongsTo('Tragala\User','user_id');
  }
}
