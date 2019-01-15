<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Question extends Model
{
    protected $guarded = [];

    protected $fillable = ['title', 'body', 'user_id'];

    protected $with = ['user', 'answers'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function latestPaginated() {
        return $this->latest()->paginate(10);
    }
    
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getUrlAttribute() {
        return route("questions.show", $this->slug);
    }

    public function getCreatedAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getVoteStringAttribute() {
        return str_plural('vote', $this->votes);
    }

    public function getAnswerStringAttribute() {
        return str_plural('answer', $this->answers_count);
    }

    public function getViewStringAttribute() {
        return $this->views . " " . str_plural('view', $this->views);
    }

    public function getStatusAttribute() {
        if($this->answers_count > 0) {
            if($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }

        return "unanswered";
    }

    public function getBodyHtmlAttribute() {
        return \Parsedown::instance()->text($this->body);
    }

    public function addAnswer($request) {
        return $this->answers()->create([
            'body' => $request,
            'user_id' => auth()->user()->id
        ]);
    }

    public function acceptBestAnswer(Answer $answer) {
        $this->best_answer_id = $answer->id;
        $this->save();
    }
}
