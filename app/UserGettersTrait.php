<?php

namespace App;

use Thomaswelton\LaravelGravatar\Facades\Gravatar;

trait UserGettersTrait
{
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