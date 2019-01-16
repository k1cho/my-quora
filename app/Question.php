<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Question extends Model
{
    use VotableTrait, QuestionGettersTrait;


    protected $guarded = [];

    protected $fillable = ['title', 'body', 'user_id'];

    protected $with = ['user', 'answers'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function favorites() {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function latestPaginated() {
        return $this->latest()->paginate(10);
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

    public function isFavorited() {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }
}
