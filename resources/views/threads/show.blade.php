@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#">{{ $thread->creator->name }}</a> Posted: {{ $thread->title }}
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
        </div>

        <div class="col-md-8">     
            <div class="card mt-4">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>  
        </div>

        <div class="col-md-8 col-md-offset-2">
            @if(auth()->check())
                <div class="card mt-5"> 
                    <form action="{{ route('reply.thread', ['thread' => $thread->id, 'channelId' => $thread->channel->slug]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body" id="" cols="30" rows="5"
                                placeholder="Reply to thread..."></textarea>
                        </div>
                        <button class="btn btn-primary form-control" type="submit">Reply</button>
                    </form>
                </div>  
            @else
                <h4 class="text-center mt-5">Please <a href="{{ route('login') }}">Sign in </a>to participate in this discussion</h4>
            @endif
        </div>
    </div>
</div>
@endsection
