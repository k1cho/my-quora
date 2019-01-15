@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card grey">
            <div class="card-body">
                <div class="card-title">
                    <small>
                        <strong>
                            <h1>Editing answer for: {{ $question->title }}</h1>
                        </strong>
                    </small>
                </div>
                <hr>
                <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <textarea class="from-group {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body"
                            rows="10" cols="20" style="margin: 0px; height: 100px; width: 100%;" required>{{ old('body', $answer->body) }}</textarea>
                        @if ($errors->has('body'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('body') }}</strong>
                        </div>
                        @endif
                    </div>
                    <div class="from-group">
                        <button type="submit" class="btn btn-block btn-outline-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
  
@endsection
