<?php

namespace Tragala;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = ['comment'];

    public function commentable()
    {
      return $this->morphTo();
    }

    public function user()
    {
      return $this->belongsTo('Tragala\User','user_id');
    }
}
