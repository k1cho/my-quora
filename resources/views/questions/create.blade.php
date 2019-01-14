@extends('layouts.app')

@section('content')
<div class="container lighter-grey">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <br>
            <div class="d-flex align-items-center">
                <h2>Ask a Question</h2>
                <div class="ml-auto">
                    <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Questions</a>
                </div>
            </div>
            <hr>
            <div class="card grey">
                <div class="card-body">
                    <form action="{{ route('questions.store') }}" method="POST">
                        {{ csrf_field() }}
                        @include('questions._form', ['button' => 'Ask'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
