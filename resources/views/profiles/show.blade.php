@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <h1>
            {{ $profileUser->name }} 
        </h1>
        <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
        <hr>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8I">
            <div class="card">
                <div class="card-header">User Threads</div>

                <div class="card-body">
                   @foreach($profileUser->threads as $thread)
                    <article>
                        <div class="flex-center">
                            <h4 class="flex">
                                <a href="{{ route('profile.show', ['user' => $thread->creator->name]) }}">
                                    {{ $thread->creator->name }}
                                </a>
                                Posted:
                                <a href="{{ route('threads.show', ['channel' => $thread->channel->slug, 'thread' => $thread->id]) }}">
                                    {{ $thread->title }}
                                
                            </h4>

                            <a href="{{ route('threads.show', ['channel' => $thread->channel->slug, 'thread' => $thread->id]) }}">
                                <strong>{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</strong>
                            </a>

                        </div>

                        <div class="body">
                            {{ $thread->body }}
                        </div>
                        <hr>
                    </article>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop