<?php

namespace App;

trait AnswerGettersTrait
{
    public function getBodyHtmlAttribute() {
        return clean(\Parsedown::instance()->text($this->body));
    }

    public function getCreatedAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute() {
        return $this->isBest() ? 'vote-accepted' : 'vote-accept';
    }
}