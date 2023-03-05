@extends('layouts.admin');
@section ('content')
<div class="container">
    <div class="row">
        <div class="col-12 my-5">
            <h2>modifica Post</h2>
            </div> 
            @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <ul class="list-unstyled">
                <li>{{$error}} </li>
                @endforeach
            </ul>
            </div>
            @endif
            <div class="col-12">
                <form action="{{ route('admin.posts.update, $post->slug')}}" method="POST">
                    @csrf
                    @method('PUT')
            <div class="form-group">
                 <label class="control-label">
                    Autore
                 </label>
                 <input type="text" class="form-control" placeholder="Autore" id="author" name="author" value="{{old('author') ?? $post->author}}">
                 @error('title')
                 <div class=text-danger>{{$message}}</div>
                 @enderror
               </div>

               <div class="form-group">
                 <label class="control-label">
                    Contenuto
                 </label>
             
                 <textarea class="form-control" placeholder="Contenuto" id="content" name="content"></textarea>
                  <div class=form-group>
                    <button type="submit" class="btn">Salva post</button>
                  </div>
               </div>
                </form>
            </div>
          
           
        </div>
    </div>
</div>
@endsection

