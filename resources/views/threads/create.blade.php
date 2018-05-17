@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                    @if(count($errors))
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <li class="list-unstyled">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('threads.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Enter Thread Title" required>
                        </div>

                        <div class="form-group">
                            <label for="sel1">Select a Channel:</label>
                            <select name="channel_id" id="channel_id"  class="form-control" id="selch" required>
                                <option value="">Choose one</option>
                                @foreach($channels as $channel)
                                <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : ''}}>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" value="{{ old('body') }}" placeholder="Enter Thread Body" cols="30" rows="10" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Create Thread</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
