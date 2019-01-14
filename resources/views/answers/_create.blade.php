<div class="row mt-4">
        <div class="col-md-12">
            <div class="card grey">
                <div class="card-body">
                    <div class="card-title">
                        <small>
                            <strong>
                                Answer here:
                            </strong>
                        </small>
                    </div>
                    <hr>
                    <form action="{{ route('questions.answers.store', $question->id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                        <textarea class="from-group {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body" rows="10" cols="20" style="margin: 0px; height: 100px; width: 100%;" required>{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('body') }}</strong>
                        </div>
                        @endif
                        </div>
                        <div class="from-group">
                            <button type="submit" class="btn btn-block btn-outline-primary">Answer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>