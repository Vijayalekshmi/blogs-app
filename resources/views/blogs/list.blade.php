<div class="p-6 bg-white border-b border-gray-200"> 
                @if (count($posts) > 0)                   
                    @foreach ($posts as $post)                                   
                    <div class="row">
                        <div class="col-md-8">
                            <article id="">
                                <header>
                                    <div class="meta">
                                        Written by <span class="author">{{ $post->user->name }} at </span>
                                         <span class="date">{{  $post->created_at->format('d/m/Y') }}</span> 
                                        |<span class="comments">
                                            <span class="badge">{{ $post->comments->count() }}</span> Comments
                                        </span>
                                    </div>
                                    <h2>
                                        <a href="">
                                        Blog title</a></h2>
                                    </header>
                                    <div class="entry-content">
                                        <a href="">
                                            <img src="http://placehold.it/750x420" alt="" class="img-fluid" />
                                        </a>
                                        <p class="lead">{!!  \Illuminate\Support\Str::limit($post->content,150, $end='...') !!}  </p>

                                        <a href="#" class="btn btn-primary">Read More <span class="glyphicon glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                                    </div>
                                <footer>
                                </footer>
                            </article>
                        </div>
                    </div>
                  
                    @endforeach
                @else
                    <p>No posts found</p>
                @endif
                </div>