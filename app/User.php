<?php

namespace Tragala;

use Tragala\Posts;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password', 'last_name', 'username', 'location', 'hash', 'verified', 'activate','gender','banner','avatar','banned_at', 'banned'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function mySubscribers()
    {
      return $this->belongsToMany('Tragala\User','friends','user_id','friend_id');
    }

    public function subscribedTo()
    {
      return $this->belongsToMany('Tragala\User','friends','friend_id','user_id');
    }

    public function subscribers()
    {
      return $this->mySubscribers()->wherePivot('accepted',true)->get()->merge($this->subscribedTo()->wherePivot('accepted',true)->get());
    }

    public function subscribeRequests()
    {
      return $this->mySubscribers()->wherePivot('accepted',false)->get();
    }

    public function subscribeRequestsPending()
    {
      return $this->subscribedTo()->wherePivot('accepted',false)->get();
    }

    public function hasSubscribeRequestsPending($id)
    {
      return (bool) $this->subscribeRequestsPending()->where('friend_id',$id)->count();
    }

    public function hasSubscribeRequest(User $user)
    {
      return (bool) $this->subscribeRequests()->where('friend_id',$user->id)->count();
    }

    public function subscribeUser(User $user)
    {
      $this->subscribedTo()->attach($user->id);
    }

    public function acceptSub(User $user)
    {
      $this->subscribeRequests()->where('id',$user->id)->first()->pivot->update(['accepted'=>true]);
    }

    public function isSubbedBack(User $user)
    {
      $this->subscribers()->where('id',$user)->count();
    }

    public function likes()
    {
      return $this->hasMany('Tragala\Likes','user_id');
    }

    public function dislikes()
    {
      return $this->hasMany('Tragala\Dislikes','user_id');
    }

    public function comments()
    {
      return $this->hasMany('Tragala\Comments','user_id');
    }

    public function hasLiked(Posts $post)
    {
      return (bool) $post->likes()
      ->where('likeable_id',$post->id)
      ->where('likeable_type',get_class($post))
      ->where('user_id', $this->id)
      ->count();
    }

    public function hasDisliked(Posts $post)
    {
      return (bool) $post->dislikes()
      ->where('dislikeable_id',$post->id)
      ->where('dislikeable_type',get_class($post))
      ->where('user_id', $this->id)
      ->count();
    }
}
