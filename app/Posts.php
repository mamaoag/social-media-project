<?php

namespace Tragala;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = ['title','description','filename','category','user_id','comment',];

    public function user()
    {
      return $this->belongsTo('Tragala\User','user_id');
    }

    public function scopeNotReply($query)
    {
      return $query->whereNull('parent_id');
    }

    public function comments()
    {
      return $this->morphMany('Tragala\Comments', 'commentable');
    }

    public function likes()
    {
      return $this->morphMany('Tragala\Likes', 'likeable');
    }

    public function dislikes()
    {
      return $this->morphMany('Tragala\Dislikes', 'dislikeable');
    }
}
