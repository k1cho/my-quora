<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Thomaswelton\LaravelGravatar\Facades\Gravatar;

use App\Question;

class User extends Authenticatable
{
    use Notifiable, UserGettersTrait;

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

    public function votesQuestions() {
        return $this->morphedByMany(Question::class, 'votable');
    }

    public function votesAnswers() {
        return $this->morphedByMany(Answer::class, 'votable');
    }

    public function voteQuestion(Question $question, $vote) {
        $votesQuestions = $this->votesQuestions();

        $this->_vote($votesQuestions, $question, 'App\Question', $vote);
    }

    public function voteAnswer(Answer $answer, $vote) {
        $votesAnswers = $this->votesAnswers();

        $this->_vote($votesAnswers, $answer, 'App\Answer', $vote);
    }

    private function _vote($relationship, $model, $className, $vote) {
        if($relationship->where('votable_type', $className)->where('votable_id', $model->id)->exists()) {
            $relationship->updateExistingPivot($model, ['vote' => $vote]);
        }
        else {
            $relationship->attach($model, ['vote' => $vote]);
        }

        $model->load('votes');
        $downVote = (int) $model->downVote()->sum('vote');
        $upVote = (int) $model->upVote()->sum('vote');
        $model->votes_count = $upVote + $downVote;
        $model->save();
    }
}
