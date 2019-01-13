@extends('layouts.app')

@section('content')
<div class="container">
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
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}">
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">{{ $errors->first('title') }}</div>                                
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" rows="10"> </textarea>
                            @if ($errors->has('body'))
                                <div class="invalid-feedback">{{ $errors->first('body') }}</div>                                
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-lg">Ask</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
