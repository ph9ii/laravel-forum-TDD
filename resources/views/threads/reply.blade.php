<div class="card-header">
        <div class="flex-center">
             <h5 class="flex">
                <a href="#">{{ $reply->owner->name }}</a> replied {{ $reply->created_at->diffForHumans() }}
             </h5>

             <div>
                     
                <form action="{{ route('replies.favorites', ['reply' => $reply->id]) }}" method="POST">
                        {{ csrf_field() }}
                    <button id="fav" class="btn btn-outline-success" type="submit" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ $reply->isFavorited() ? 'Favorited' : 'Favorite' }}
                    </button>
                        {{-- <fav-component></fav-component> --}}
                </form>
             </div>
        </div>
    </div>
    <div class="card-body">
        {{ $reply->body }}
</div>