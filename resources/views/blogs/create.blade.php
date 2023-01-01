<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         {{ __('Create Post') }}
      </h2>
      
   </x-slot>
   <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        
            <div class="row pl-5 card pt-5">
               <div class="col-md-8 ">
                  <span class="comments" style="padding-bottom:20px">
                     <div class="container" style='margin-bottom: 34px'>
                        <form method="POST" action="{{ route('posts.store') }}" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                            <span class="correction"></span>
                            <button type="button" class="btn btn-primary" style='background-color: #007bff;float: right;' id="check_spell" >Check Spell</button>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="3" required>{{ old('content') }}</textarea>
                        </div>
                     
                        <div class="form-group">
                            <label for="image">Banner Image</label>
                            <input type="file" class="form-control-file" id="image" name="image"  value="{{ old('image') }}">
                        </div>
                        <button type="submit" class="btn btn-primary" style='background-color: #007bff;'>Create Post</button>
                        </form>

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
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded'
      
    });
    $('#check_spell').on('click',function(event){
         event.preventDefault();
         elem=$(this)
         val=$('#title').val()
         axios.post('/posts/check-spell/'+val)
         .then(function (response) {
            console.log(response.data)
            if(response.data){
               $('.correction').html('Correct word: '+response.data)
            }else{
               $('.correction').html('The sentence is correct')
            }
         })
      })
  </script>
</x-app-layout>