<?php

namespace App;

trait QuestionGettersTrait
{
    //only one setter, no need to create a new file
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    // public function setBodyAttribute($value) {
    //     $this->attributes['body'] = clean($value);
    // }
    
    public function getUrlAttribute() {
        return route("questions.show", $this->slug);
    }

    public function getCreatedAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getVoteStringAttribute() {
        return str_plural('vote', $this->votes_count);
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
        return clean($this->bodyHtml());
    }

    public function getFavoritesCountAttribute() {
        return $this->favorites()->count();
    }

    public function getExcerptAttribute() {
        return $this->excerpt(300);
    }

    private function excerpt($length) {
        return str_limit(strip_tags($this->body_html), $length);
    }

    private function bodyHtml() {
        return \Parsedown::instance()->text($this->body);
    }
}