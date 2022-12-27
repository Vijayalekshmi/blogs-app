<div class="p-6 bg-white border-b border-gray-200">
   @if (count($posts) > 0)                   
   @foreach ($posts as $post)                                   
   <div class="row">
      <div class="col-md-8">
         <h1 style="font-size: 20px;">
            <b> {{ $post->title }} </b>
         </h1>
         <hr>
         <br>
         <div class="meta">
            <span class="comments" style="float:right">
            <span class="badge">{{ $post->comments->count() }}</span> Comments
            </span>
            <h5>
               Post by {{ $post->user->name }} , {{  $post->created_at->toFormattedDateString() }}
            </h5>
         </div>
         </span>
         </span>
         <p>{!!  \Illuminate\Support\Str::limit($post->content,150, $end='...') !!} </p>
         <a href="{{ route('posts.show', ['post' => $post]) }}" class="btn btn-primary">Read More <span class="glyphicon glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
         <br><br>
      </div>
   </div>
   @endforeach
   {{ $posts->links() }}
   @else
   <p>No posts found</p>
   @endif
</div>
