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

    public function votesQuestions() {
        return $this->morphedByMany(Question::class, 'votable');
    }

    public function votesAnswers() {
        return $this->morphedByMany(Answer::class, 'votable');
    }

    public function voteQuestion(Question $question, $vote) {
        $votesQuestions = $this->votesQuestions();

        if($votesQuestions->where('votable_id', $question->id)->exists()) {
            $votesQuestions->updateExistingPivot($question, ['vote' => $vote]);
        }
        else {
            $votesQuestions->attach($question, ['vote' => $vote]);
        }

        $question->load('votes');
        $downVote = (int) $question->downVote()->sum('vote');
        $upVote = (int) $question->upVote()->sum('vote');
        $question->votes_count = $upVote + $downVote;
        $question->save();
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
