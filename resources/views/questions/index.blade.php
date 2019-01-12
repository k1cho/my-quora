@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <br>
            <h2>All Questions</h2>
            <hr>
            @foreach ($questions as $question)
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="vote">
                                <strong>{{ $question->votes }}</strong> {{ $question->vote_string }}
                            </div>
                            <div class="status {{ $question->status }}">
                                <strong>{{ $question->answers }}</strong> {{ $question->answer_string }}
                            </div>
                            <div class="view">
                                {{ $question->view_string }}
                            </div>
                        </div>
                        <div class="media-body">
                            <h3 class="mt-0">
                                <a href="{{ $question->url }}">{{ $question->title }}</a>
                            </h3>
                            <p class="lead">
                                Asked by <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                <small class="text-muted">
                                    {{ $question->created }}
                                </small>
                            </p>
                            {{ str_limit($question->body, 250) }}
                        </div>
                    </div>
                </div>
            </div>
            <br>
            @endforeach
            <br>
            <div class="mx-auto">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
