<?php

namespace Tragala;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $fillable = ['user_id'];
    public function likeable()
    {
      return $this->morphTo();
    }

    public function user()
    {
      return $this->belongsTo('Tragala\User','user_id');
    }
}
