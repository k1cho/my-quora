<div class="row mt-4">
    <div class="col-md-12">
        <div class="card grey">
            <div class="card-body">
                <div class="card-title">
                    <small>
                        <strong>
                            {{ $answerCount . " " . str_plural('Answer', $answerCount) }}
                        </strong>
                    </small>
                </div>
                <hr>
                @include('layouts._messages')
                @forelse ($answers as $answer)
                <div class="card grey">
                    <div class="card-body">
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a title="This answer is useful" class="vote-up {{ Auth::guest() ? 'off' : 'vote-accept' }}">
                                    <i class="fas fa-caret-up fa-2x"></i>
                                </a>
                                <span class="votes-count">123</span>
                                <a title="This answer is not useful" class="vote-down {{ Auth::guest() ? 'off' : 'downvote' }}"><i class="fas fa-caret-down fa-2x"></i></a>
                                @can('accept', $answer)
                                <a title="Accept answer" 
                                    class="{{ $answer->status }} mt-2" 
                                    onclick="event.preventDefault(); 
                                    document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                                <form action="{{ route('answers.accept', $answer->id) }}" method="POST" id="accept-answer-{{ $answer->id }}"
                                    style="display:none;">
                                    {{ csrf_field() }}
                                </form>
                                @else
                                @if ($answer->isBest())
                                    <a title="Best Answer" class="{{ $answer->status }} mt-2">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                                @endcan
                            </div>
                            <div class="media-body">
                                {!! $answer->body_html !!}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="ml-auto">
                                            @can('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                                class="btn btn-sm btn-outline-info">Edit</a>
                                            @endcan
                                            @can('delete', $answer)
                                            <form class="form-delete" method="post" action="{{ route('questions.answers.destroy', [$question->id, $answer->id])}}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
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
