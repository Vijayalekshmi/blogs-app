<div class="card">
 <div class="card-body">
<div class="row">
    <div class="col-md-2">
          
    <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
    <p class="text-secondary text-center">{{  $comment->created_at->toFormattedDateString()  }}</p>
   
    </div>
    <div class="col-md-10">
    
        <a class="float-left" href=""><strong>{{  $comment->user->name }} </strong></a>
        
    
    <div class="clearfix"></div>
    <p>{{ $comment->comment }}</p>
    @if($comment->hasEditPermission(auth()->user()) and !request()->routeIs('dashboard') and !request()->routeIs('users.show'))
    <a data-id='{{  $comment->id }}'  data-old-value='{{  $comment->comment }}' class="btn btn-primary edit-button" style='float:right;margin: 4px;' class='comment_edit'>
        Edit
    </a> 
    @endif 
    <div>
    </div>
    </div>
</div>
</div>
</div>