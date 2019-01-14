@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <br>
            <div class="d-flex align-items-center">
                <h2>All Questions</h2>
                <div class="ml-auto">
                    <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask a Question</a>
                </div>
            </div>
            <hr>
            @include('layouts._messages')
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
                            <div class="d-flex align-items-center">
                                <h3 class="mt-0">
                                    <a href="{{ $question->url }}">{{ $question->title }}</a>
                                </h3>
                                <div class="ml-auto">
                                    @can('update', $question)
                                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                    @endcan
                                    @can('delete', $question)
                                    <form class="form-delete" method="post" action="{{ route('questions.destroy', $question->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    @endcan
                                </div>
                            </div>

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
