@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                    <form action="{{ route('threads.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" name="title" id="title" placeholder="Enter Thread Title">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" placeholder="Enter Thread Body" cols="30" rows="10" class="form-control"></textarea>
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
