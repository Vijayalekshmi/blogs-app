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
                              <!-- Edit form template -->
                              <template id="edit-form-template">
                              <form class="edit-form" >
                                 <input type="hidden" name="id" value="">
                                 <textarea name="comment" class='edit-comment'></textarea>                                
                                 <button type="submit" class='btn btn-primary' style='background-color: #007bff;' >Save</button>
                                 <button type="button" class='btn btn-primary cancel-edit' style='background-color: #007bff;' >Cancel</button>
                              </form>
                              </template>
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
      $('.edit-button').click(function () {
         // Get the parent list item and the current comment text
         const listItem = $(this).parent();
         const currentComment = listItem.find('p').text();
         // Get the edit form template and set the value of the "id" and "comment" fields
         const formTemplate = $('#edit-form-template').html();
         const form = $(formTemplate);
         form.find('input[name="id"]').val($(this).data('id'));
         form.find('textarea[name="comment"]').html(currentComment);

         // Replace the comment with the form
         listItem.find('p').replaceWith(form);
         });
   
         $(document).on("submit", ".edit-form", function(event) {    
        
               // Prevent the default form submission behavior
               event.preventDefault();         
               // Get the form data
               const data = $(this).serialize();
               comment_id=$(this).children('[name="id"]').val()
               axios.post('/comments/'+comment_id+'/edit',  data)
               .then(function (response) {            
                  const listItem = $(event.target).parent();
                  listItem.find('form').replaceWith('<p>'+response.data.comment+'</p>');
               })

          });
          $(document).on("click", ".cancel-edit", function(event) { 
            comment=$(this).siblings('.edit-comment').val()
            $(this).parent('.edit-form').replaceWith('<p>'+comment+'</p>')
          });    
          
   })
</script>
</x-app-layout>