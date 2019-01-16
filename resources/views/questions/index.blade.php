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
            @forelse ($questions as $question)
            <div class="card grey">
                <div class="card-body">
                    <div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="vote">
                                <strong>{{ $question->votes_count }}</strong> {{ $question->vote_string }}
                            </div>
                            <div class="status {{ $question->status }}">
                                <strong>{{ $question->answers_count }}</strong> {{ $question->answer_string }}
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
                            <div class="excerpt">{{ $question->excerpt }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            @empty
                <br>
                <h2 class="text-center">No Questions yet.</h2>
            @endforelse
            <br>
            <div class="mx-auto">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
