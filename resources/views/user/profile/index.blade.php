@extends('templates.default')
@section('content')
	<div class="row">
	    <div class="col-lg-5">
	       @include('user.partials.userblock')
	       <hr>
	       <!-- Timeline statuses and replies -->
	       @if(!$statuses->count())
				<p>There's nothing in {{ $user->getFirstNameOrUsername() }}'s timeline, yet.</p>
			@else
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
					            @if($status->user->id !== auth()->user()->id)
						            <li><a href="{{ url('status/like', ['statusId' => $status->id]) }}">Like</a></li>
					            @endif
					            <li>{{ $status->likes->count() }} {{ str_plural('like', $status->likes->count()) }}</li>
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
						                    @if($reply->user->id !== auth()->user()->id)
							                    <li><a href="{{ url('status/like', ['statusId' => $reply->id]) }}">Like</a></li>
						                    @endif
						                    <li>{{ $reply->likes->count() }} {{ str_plural('like', $reply->likes->count()) }}</li>
						                </ul>
						            </div>
						        </div>
					 		@endforeach

					 		@if($authUserIsFriend || auth()->user()->id === $status->user->id)
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
					        @endif
					    </div>
					</div>
				@endforeach
				{!! $statuses->render() !!}
    		@endif
	    </div>
	    <div class="col-lg-4 col-lg-offset-3">
	    	@if(auth()->user()->hasFriendRequestPending($user))
	    		<p>Waiting for {{ $user->getNameOrUsername() }} to accept your request</p>
	    	@elseif(auth()->user()->hasFriendRequestReceived($user))
	    		<a href="{{ url('friends/accept', ['username' => $user->username]) }}" class="btn btn-primary">Accept friend request</a>
    		@elseif(auth()->user()->isFriendsWith($user))
    			<p>You and {{ $user->getNameOrUsername() }} are friends</p>
    			<form action="{{ url('friends/delete', ['username' => $user->username]) }}" method="POST" role="form">
    				{!! Form::token() !!}
					<button type="submit" class="btn btn-primary">Unfriend</button>
				</form>
			@elseif(auth()->user()->id !== $user->id)
				<a href="{{ url('friends/add', ['username' => $user->username]) }}" class="btn btn-primary">Add as friend</a>
	    	@endif

            <h4>{{ $user->getFirstNameOrUsername() }}'s friends</h4>
            @if(!$user->friends()->count())
            	<p>{{ $user->getFirstNameOrUsername() }} has no friends</p>
            @else
            	@foreach($user->friends() as $user)
            		@include('user.partials.userblock')
            	@endforeach
            @endif
	    </div>
	</div>
@endsection