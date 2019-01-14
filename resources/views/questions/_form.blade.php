<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" value="{{ old('title', $question->title) }}" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}">
    @if ($errors->has('title'))
    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
    @endif
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea name="body" id="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"
        rows="10">{{ old('body', $question->body) }} </textarea>
    @if ($errors->has('body'))
    <div class="invalid-feedback">{{ $errors->first('body') }}</div>
    @endif
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg">{{ $button }}</button>
</div>
