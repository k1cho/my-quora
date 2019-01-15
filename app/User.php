<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Thomaswelton\LaravelGravatar\Facades\Gravatar;

use App\Question;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function favorites() {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

    public function getUrlAttribute() {
        //return route("users.show", $this->id);
        return '#';
    }

    public function getAvatarAttribute () {
        // $email = $this->email;
        // $size = 10;

        // return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "&s=" . $size;

        return Gravatar::image("https://www.gravatar.com/avatar/", 'Avatar', ['width' => 30, 'height' => 30]);
    }

}
