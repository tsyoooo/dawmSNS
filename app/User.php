<?php

namespace App;

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
        'username', 'mail', 'password', 'bio' ,'images',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setAttribute($key, $value){
    if ($key !== $this->getRememberTokenName()) {
    parent::setAttribute($key, $value);
    }
    }

    /**
     * Relationships
     */

    /*フォローしてるユーザー情報をすべて取得取得*/
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'follow', 'follower');
    }

    /*フォロワーのユーザー情報をすべて取得取得*/
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'follow', 'follower');
    }
}
