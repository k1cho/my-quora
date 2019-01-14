<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Question extends Model
{
    protected $guarded = [];

    protected $fillable = ['title', 'body', 'user_id'];

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

    public function getVoteStringAttribute() {
        return str_plural('vote', $this->votes);
    }

    public function getAnswerStringAttribute() {
        return str_plural('answer', $this->answers);
    }

    public function getViewStringAttribute() {
        return $this->views . " " . str_plural('view', $this->views);
    }

    public function getStatusAttribute() {
        if($this->answers > 0) {
            if($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }

        return "unanswered";
    }
}
