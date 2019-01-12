<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Question extends Model
{
    protected $fillable = ['title', 'body'];

    protected $with = ['user'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function latestPaginated() {
        return $this->latest()->paginate(5);
    }
    
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getUrlAttribute() {
        return route("questions.show", $this->id);
    }

    public function getCreatedAttribute() {
        return $this->created_at->diffForHumans();
    }
}
