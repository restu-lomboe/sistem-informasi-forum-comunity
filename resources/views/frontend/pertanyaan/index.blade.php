@extends('layouts.master')

@section('css')
<style>
    .form-ask{
        -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
    }
</style>
@endsection

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-8">
                <h1 class="h4 mt-5">Buat Pertanyaan kamu kedalam forum</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur, fugiat!</p>
            </div>
            <div class="col-md-4">
                <img src=" {{ asset('images/bgask.PNG') }} " alt="" width="100%">
            </div>
        </div>

        @if( Session::has('status'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <center><strong>{!! session('status') !!}</strong></center>
            </div>
        @endif

        <form class="border mt-3 p-4 rounded form-ask" action=" {{ route('pertanyaan.store') }} " method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <p class="font-weight-bold">Judul</p>
                <small>Note* : Lebih spesifik dan bayangkan Anda mengajukan pertanyaan kepada orang lain</small>
                <input type="text" name="judul" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <p class="font-weight-bold">Isi</p>
                <small>Note* : Sertakan semua informasi yang diperlukan seseorang untuk menjawab pertanyaan Anda</small>
                <textarea id="my-editor" name="content" class="form-control" required>{!! old('content', 'test editor content') !!}</textarea>
            </div>
            <div class="form-group">
                <p class="font-weight-bold">Tag</p>
                <small>Note* : Tambahkan hingga 5 tag untuk menjelaskan tentang pertanyaan Anda</small>
                <select name="tag[]" class="form-control" id="" multiple required>
                    @foreach ($tags as $tag)
                        <option value=" {{ $tag->id }} "> {{ $tag->nama }} </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Submit</button>
        </form>
    </div>
@endsection

@section('script')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
</script>
<script>
    CKEDITOR.replace('my-editor', options);
</script>
@endsection
