@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <br>
            <div class="d-flex align-items-center">
                <h2><strong>{{ $question->title }}</strong></h2>
                <div class="ml-auto">
                    <a href="{{ route('questions.index') }}" class="btn btn-sm btn-outline-secondary">Back to all
                        Questions</a>
                </div>
            </div>
            <hr>
            <div class="card grey">
                <div class="card-body">
                    <div class="media" style="font-size: 20px;">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This question is useful" class="vote-up {{ Auth::guest() ? 'off' : 'vote-accept' }}"
                                onclick="event.preventDefault(); 
                                document.getElementById('upvote-question-{{ $question->id }}').submit();">
                                <i class="fas fa-caret-up fa-2x"></i>
                            </a>
                            <span class="votes-count">{{ $question->votes_count }}</span>
                            <form action="/questions/{{ $question->id }}/vote" method="POST" id="upvote-question-{{ $question->id }}"
                                style="display:none;">
                                {{ csrf_field() }}
                                <input type="hidden" name="vote" value="1">
                            </form>
                            
                            <a title="This question is not useful" class="vote-down {{ Auth::guest() ? 'off' : 'downvote' }}"
                                onclick="event.preventDefault(); 
                                document.getElementById('downvote-question-{{ $question->id }}').submit();">
                                <i class="fas fa-caret-down fa-2x"></i>
                            </a>
                            <form action="/questions/{{ $question->id }}/vote" method="POST" id="downvote-question-{{ $question->id }}"
                                style="display:none;">
                                {{ csrf_field() }}
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            <a title="Mark as Favorite" 
                                class="mt-2 {{ Auth::guest() ? 'off' : ($question->isFavorited() ? 'favorited' : 'favorite') }}"
                                onclick="event.preventDefault(); 
                                document.getElementById('favorite-question-{{ $question->id }}').submit();">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">{{ $question->favorites_count }}</span>
                            </a>
                            <form action="/questions/{{ $question->id }}/favorite" method="POST" id="favorite-question-{{ $question->id }}"
                                style="display:none;">
                                {{ csrf_field() }}
                                @if ($question->isFavorited())
                                    {{ method_field('DELETE') }}
                                @endif
                            </form>
                        </div>
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">
                                    Created {{ $question->created }}
                                </span>
                                <div class="media mt-2">
                                    <a href="{{ $question->user->url }}" class="pr-2">
                                        {!! $question->user->avatar !!}
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._create')
    @include('answers._index', ['answers' => $question->answers, 'answerCount' => $question->answers_count])
</div>
@endsection
