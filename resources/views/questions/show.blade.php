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
                <div class="card-body" style="font-size: 20px;">
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
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card grey">
                <div class="card-body">
                    <div class="card-title">
                        <small><strong>{{ $question->answers_count . " " . str_plural('Answers',
                                $question->answers_count) }}</strong></small>
                    </div>
                    <hr>
                    @forelse ($question->answers as $answer)
                    <div class="card grey">
                        <div class="card-body">
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
