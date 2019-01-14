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
                            <a title="This question is useful" class="vote-up on">
                                <i class="fas fa-caret-up fa-2x"></i>
                            </a>
                            <span class="votes-count">123</span>
                            <a title="This question is not useful" class="vote-down off"><i class="fas fa-caret-down fa-2x"></i></a>
                            <a title="Mark as Favorite" class="favorite mt-2 favorited">
                                <i class="fas fa-star fa-2x"></i>
                            </a>
                            <span class="favorites-count">123</span>
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
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card grey">
                <div class="card-body">
                    <div class="card-title">
                        <small>
                            <strong>
                                {{ $question->answers_count . " " . str_plural('Answers',
                                $question->answers_count) }}
                            </strong>
                        </small>
                    </div>
                    <hr>
                    @forelse ($question->answers as $answer)
                    <div class="card grey">
                        <div class="card-body">
                            <div class="media">
                                <div class="d-flex flex-column vote-controls">
                                    <a title="This answer is useful" class="vote-up on">
                                        <i class="fas fa-caret-up fa-2x"></i>
                                    </a>
                                    <span class="votes-count">123</span>
                                    <a title="This answer is not useful" class="vote-down off"><i class="fas fa-caret-down fa-2x"></i></a>
                                    <a title="Accept answer" class="vote-accept mt-2 favorited">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                </div>
                                <div class="media-body">
                                    {!! $answer->body_html !!}
                                    <div class="float-right">
                                        <span class="text-muted">
                                            Answered {{ $answer->created }}
                                        </span>
                                        <div class="media mt-2">
                                            <a href="{{ $answer->user->url }}" class="pr-2">
                                                {!! $answer->user->avatar !!}
                                            </a>
                                            <div class="media-body mt-1">
                                                <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @empty
                    <h2>No answers yet.</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
