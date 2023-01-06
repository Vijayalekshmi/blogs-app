<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(request()->routeIs('dashboard'))
                {{ __('Dashboard: Your Posts') }} 
            @else
                Activities by {{ $posts->first()->user->name }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <h1 style="font-size: 20px;padding: 20px;">
                <b> Posts </b>
            </h1>
            <hr>
            <br>
                 @include('blogs.list') 
            </div>
            <br>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <h1 style="font-size: 20px;padding: 20px;">
                <b> Comments </b>
            </h1>
            <hr>
            <br>
            <div class="row pl-5">
            <div class="col-md-2 ">
               <h2><b> Commented Post </b> </h2>
               <br>
            </div>
            <div class="col-md-5 ">              
                <h2> <b> Comment </b> </h2>
                <br>
            </div>
            </div>
            <hr>
            <br>
                @if(count($posts->first()->user->comments)>0)
                    @foreach($posts->first()->user->comments as $comment)
                    <div class="row pl-5">
                        <div class="col-md-2 ">
                        <a href="{{ route('posts.show', ['post' => $comment->post_id]) }}"> {{$comment->post->title}} </a>
                        </div>
                    <div class="col-md-5 ">              
                        @include('blogs.comments.list')                
                    </div>
                    </div>
                    @endforeach 
                @else
                    <p style="padding: 20px;">No comments found</p>
                @endif
                <br>          
            </div>
          
        </div>
    </div>
</x-app-layout>
