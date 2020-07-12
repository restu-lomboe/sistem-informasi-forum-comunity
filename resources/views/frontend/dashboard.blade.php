@extends('layouts.master')

<<<<<<< HEAD
@section('css')
<style>
    .pagination{
        float: right;
    }
</style>
@endsection

=======
>>>>>>> 97772fbae9716cd466a33b306cabd2aedd26a2d1
@section('content')
<div class="container">
    <div class="row">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src=" {{ asset('images/bg2.jpg') }} " class="d-block w-100" alt="...">
                </div>

                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mb-4">
    <div class="row">
        <div class="col-md-8 border-bottom pb-3">
            <a href=" {{ route('pertanyaan') }} " class="btn btn-warning float-left">New Question </a>
        </div>
    </div>

</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 border-right pr-3">
            <ul class="list-unstyled text-justify">
                @foreach ($pertanyaan as $tanya)
                    <li class="media pb-3 mb-5 border-bottom">
                        <img class="mr-3 rounded-circle" src=" {{ asset('/images/profile/'.$tanya->user->foto) }} " alt=" {{ $tanya->user->nama }} " width="50">
                        <div class="media-body">
                            <h5 class="mt-0 mb-3"><a href="{{ route('pertanyaan.detail', $tanya->id) }}"> {{ $tanya->judul }} </a></h5>
                            @foreach ($tanya->tag as $item)
                                <span class="btn btn-success btn-sm mr-2"> {{ $item->nama }} </span>
                            @endforeach
                            <br>
                            <small>{{ $tanya->user->nama }}</small> .
                            <small>{{ date('Y F h', strtotime($tanya->created_at)) }}</small>
                            {{-- <small><i class="fas fa-comments"></i> 15</small> --}}
                        </div>
                    </li>
                @endforeach

            </ul>
            <div class="">
                {{ $pertanyaan->onEachSide(1)->links() }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white mb-3">
                <div class="card-header text-dark">Popular Post</div>
                <div class="card-body text-dark text-justify">
                    <ul>
                        <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, eligendi.</li>
                        <li>Lorem ipsum dolor sit amet.</li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</div>


@endsection
