<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use VotableTrait, AnswerGettersTrait;


    protected $guarded = [];

    protected $fillable = ['body', 'question_id', 'user_id'];

    protected $with = ['user'];

    public static function boot() {
        parent::boot();

        static::created(function($answer) {
            $answer->question->increment('answers_count');
        });

        static::deleted(function($answer) {
            //$question = $answer->question;
            $answer->question->decrement('answers_count');

            /*if($question->best_answer_id === $answer->id) {
                $question->best_answer_id = NULL;
                $question->save();
            }*/
        });
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function isBest() {
        return $this->id === $this->question->best_answer_id;
    }

}
