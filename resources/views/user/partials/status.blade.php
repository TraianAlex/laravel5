<!-- Timeline statuses and replies -->
@foreach($statuses as $status)
	<div class="media">
	    <a class="pull-left" href="{{ route('user.show', ['username' => $status->user->username]) }}">
	        <img class="media-object" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl() }}">
	    </a>
	    <div class="media-body">
	        <h4 class="media-heading"><a href="{{ route('user.show', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
	        <p>{{ $status->body }}</p>
	        <ul class="list-inline">
	            <li>{{ $status->created_at->diffForHumans() }}</li>
	            <li><a href="#">Like</a></li>
	            <li>10 likes</li>
	        </ul>
	 		
	 		@foreach($status->replies as $reply)
		        <div class="media">
		            <a class="pull-left" href="{{ route('user.show', ['username' => $reply->user->username]) }}">
		                <img class="media-object" alt="{{ $reply->user->getNameOrUsername() }}" src="{{ $reply->user->getAvatarUrl() }}">
		            </a>
		            <div class="media-body">
		                <h5 class="media-heading"><a href="{{ route('user.show', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
		                <p>{{ $reply->body }}</p>
		                <ul class="list-inline">
		                    <li>{{ $reply->created_at->diffForHumans() }}</li>
		                    <li><a href="#">Like</a></li>
		                    <li>4 likes</li>
		                </ul>
		            </div>
		        </div>
	 		@endforeach
	        <form role="form" action="{{ url('status/reply', ['statusId' => $status->id]) }}" method="post">
	        	{!! Form::token() !!}
	            <div class="form-group {{ $errors->has("reply-{$status->id}") ? 'has-error' : ''}}">
	                <textarea name="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
	                @if($errors->has("reply-$status->id"))
                    <span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span>
                @endif
	            </div>
	            <input type="submit" value="Reply" class="btn btn-default btn-sm">
	        </form>
	    </div>
	</div>
@endforeach
{!! $statuses->render() !!}