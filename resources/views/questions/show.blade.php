@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <br>
            <div class="d-flex align-items-center">
                <h1>{{ $question->title }}</h1>
                <div class="ml-auto">
                    <a href="{{ route('questions.index') }}" class="btn btn-sm btn-outline-secondary">Back to all Questions</a>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    {!! $question->body_html !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
