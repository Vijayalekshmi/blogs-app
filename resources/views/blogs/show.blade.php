<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('Posts') }}
      </h2>
   </x-slot>
   <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="row justify-content-center">
               <div class="col-md-11 ">    
               <a data-id='{{  $post->id }}' class="btn btn-primary" style='float:right;margin: 4px;' id='post_like'>
               @if($post->likes()->where('user_id', auth()->id())->exists())
                  Liked
               @else
                  Like
               @endif
               </a>           
                  <h1 style="font-size: 20px;padding-top:20px" >
                     <b> {{ $post->title }} </b>
                     
                  </h1>  
                  <hr>
                <br>
                <div class="meta">                
                    <h5>
                    Post by <a href="{{ route('users.show', ['user' => $post->user]) }}"> {{ $post->user->name }} </a> , {{  $post->created_at->format('d/m/Y') }}
                    </h5>
                </div>
                </span>
                </span>
                @if($post->image)
                  <div>
                     <img src="{{ asset('images/' .$post->image->url) }}" >
                  </div>
                @endif
                <p>{!!$post->content !!} </p>
                <br><br>
            </div>
            </div>
            <div class="row justify-content-center">
               <div class="col-md-11 ">
                    <h1 style="font-size: 20px;padding:10px" >
                        <b> Comments </b>
                    </h1>
                </div>
            </div>
                <hr>
                <br>
            <div class="row pl-5">
               <div class="col-md-8 ">
               <form method="POST" action="{{ route('comments.store') }}" class='comment_form' novalidate>
                  @csrf
                  <div class="form-group">
                        <label for="content">Add your comment</label>
                        <input type="hidden" value="{{  $post->id }}" name="post_id"> 
                        <textarea class="form-control"  name="comment" rows="3" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary" style='background-color: #007bff;' id="submit_button">Comment</button>
               </form>
                  <span  style="padding-bottom:20px;margin:10px">
                     <div class="container" id="comments" style='margin-bottom: 34px'>
                           @if (count($comments) > 0)                   
                              @foreach ($comments as $comment) 
                           
                                    @include('blogs.comments.list') 
                                 
                              @endforeach
                           
                           {{ $comments->links() }}
                           @else
                              <p>No comments found</p>
                           @endif
                     </div>
                  </span>
                </div>
            </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<script>
   $(document).ready(function(){
      $('#post_like').on('click',function(event){
         event.preventDefault();
         elem=$(this)
         axios.post('/posts/{{ $post->id }}/like')
         .then(function (response) {
            if(response.data.liked){
               elem.html('Liked')
            } else{
               elem.html('Like')
            } 
         })
      })
      $('.comment_form').submit(function (event)  {
         event.preventDefault();
         const data = new FormData(this);
         axios.post('/comments',  data)
         .then(function (response) {            
            $('#comments').prepend(response.data)
         })
      });
      
          
   })
</script>
</x-app-layout>