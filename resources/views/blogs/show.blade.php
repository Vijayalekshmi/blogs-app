<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('Posts') }}
      </h2>
   </x-slot>
   <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="row justify-content-center">
               <div class="col-md-11 ">
              
               <h1 style="font-size: 20px;padding-top:20px" >
                    <b> {{ $post->title }} </b>
                </h1>
                <hr>
                <br>
                <div class="meta">
                
                    <h5>
                    Post by {{ $post->user->name }} , {{  $post->created_at->format('d/m/Y') }}
                    </h5>
                </div>
                </span>
                </span>
                <p>{!!$post->content !!} </p>
                <br><br>
            </div>
            </div>
                  <span class="comments" style="padding-bottom:20px">
                     <div class="container" style='margin-bottom: 34px'>
                        @if (count($post->comments) > 0)                   
                        @foreach ($post->comments as $comment) 
                        <div class="card">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-2">
                                    <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                    <p class="text-secondary text-center">{{  $comment->created_at->toFormattedDateString()  }}</p>
                                 </div>
                                 <div class="col-md-10">
                                    <p>
                                       <a class="float-left" href=""><strong>{{  $comment->user->name }} </strong></a>
                                       <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                       <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                       <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                       <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                    </p>
                                    <div class="clearfix"></div>
                                    <p>{{ $comment->comment }}</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endforeach
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
</x-app-layout>