@extends('layouts.master')

@section('css')

@endsection

@section('content')
<div class="container mt-5">
    @if( Session::has('status'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <center><strong>{!! session('status') !!}</strong></center>
        </div>
    @endif


    <div class="row">
        <div class="col-md-8 text-justify border-right pr-3">
            <div class="row">
                <div class="col-md-1 text-center">
                    @guest
                        <a href=" {{ route('vote.up', $pertanyaan->id) }} "><i class="fas fa-sort-up fa-3x"></i></a>
                            {{ $totalvotepertanyaan }}
                        <a href=" {{ route('vote.down', $pertanyaan->id) }} "><i class="fas fa-sort-down fa-3x"></i></a>
                    @else
                        @if ($pertanyaan->user->id == Auth::user()->id)
                            <i class="fas fa-sort-up fa-3x"></i>
                            {{ $totalvotepertanyaan }}
                            <i class="fas fa-sort-down fa-3x"></i>
                        @else
                            <a href=" {{ route('vote.up', $pertanyaan->id) }} "><i class="fas fa-sort-up fa-3x"></i></a>
                            {{ $totalvotepertanyaan }}
                            <a href=" {{ route('vote.down', $pertanyaan->id) }} "><i class="fas fa-sort-down fa-3x"></i></a>
                        @endif
                    @endguest


                </div>
                <div class="col-md-11 mb-5">
                    <div class="border-bottom pb-3 mb-5" >
                        <h1 class="h3"> {{ $pertanyaan->judul }} </h1>
                        <small class="font-weight-bold" style="text-transform: capitalize;"> {{ $user->nama }} </small> .
                        <small class="font-weight-bold">Create {{ date('Y F h', strtotime($pertanyaan->created_at)) }} </small>
                        <p class="mt-3 mb-1"> {!! $pertanyaan->isi !!} </p>
                        <br>
                        @foreach ($pertanyaan->tag as $item)
                            <small class="btn btn-primary btn-sm"> {{ $item->nama }} </small>
                        @endforeach
                    </div>
                    {{-- komentar pertanyaan --}}
                    <div class="ml-5">
                        @foreach ($pertanyaan->komentar as $komen)
                            <p class="m-0 border-top border-bottom pt-2 pb-2" style="font-size: 12px;">
                            {{ $komen->isi }}
                            <a href="">-- {{ $komen->user->nama }} ,</a> {{date('Y-F-h', strtotime($pertanyaan->created_at))}} </p>
                        @endforeach

                    </div>
                    <a href="" data-toggle="modal" data-target="#komentarpertanyaan" style="font-size: 12px;">add a comment</a>
                </div>

                {{-- jawaban --}}
                <h1 class="h3"> Jawaban </h1>

                @foreach ($pertanyaan->jawaban as $jawab)
                    <div class="row mt-5 pr-3 col-md-12">
                        <div class="col-md-1 text-center">
                            @guest
                                <a href=" {{ route('jawaban.up', $jawab->id) }} "><i class="fas fa-sort-up fa-3x"></i></a>
                                   {{ $totalvotejawaban }}
                                <a href="{{ route('jawaban.down', $jawab->id) }}"><i class="fas fa-sort-down fa-3x"></i></a>
                            @else
                                @if ($jawab->user->id == Auth::user()->id)
                                    <i class="fas fa-sort-up fa-3x"></i>
                                    {{ $totalvotejawaban }}
                                    <i class="fas fa-sort-down fa-3x"></i>
                                @else
                                    <a href=" {{ route('jawaban.up', $jawab->id) }} "><i class="fas fa-sort-up fa-3x"></i></a>
                                    {{ $totalvotejawaban }}
                                    <a href="{{ route('jawaban.down', $jawab->id) }}"><i class="fas fa-sort-down fa-3x"></i></a>
                                @endif
                            @endguest

                        </div>
                        <div class="col-md-11">
                            <div class="border-bottom" style="padding-bottom: 12%;">
                                <p class="mt-3 mb-1"> {!! $jawab->isi !!} </p>
                                <br>
                                <div class="media mt-3" style="float: right;">
                                    <img class="mr-2 rounded-circle" src="{{ asset('/images/profile/'.$jawab->user->foto) }}" alt="Generic placeholder image" width="50">
                                    <div class="media-body">
                                    <small class="mt-0"> {{ $jawab->user->nama }} </small><br>
                                    <small title="point reputations"><i class="fas fa-award"></i>
                                        @foreach ($jawab->user->voteuser as $point)
                                            {{ $point->point }}
                                        @endforeach
                                    </small> .
                                    <small> {{ $jawab->created_at->diffForHumans() }} </small>
                                    </div>
                                </div>
                            </div>

                            {{-- komentar jawaban --}}
                            @foreach ($jawab->komentar as $jawabkomen)
                            <div class="ml-5 border-bottom pt-2" style="padding-bottom: 12%;">
                                <p class="m-0" style="font-size: 12px;">
                                    {{ $jawabkomen->isi }}
                                <a href="">-- {{ $jawabkomen->user->nama }} </a> {{date('Y-F-h', strtotime($jawab->created_at))}} </p>
                                <div class="media mt-3" style="float: right;">
                                    <img class="mr-2 rounded-circle" src="{{ asset('/images/profile/'.$jawabkomen->user->foto) }}" alt="{{ $jawabkomen->user->nama }}" width="50">
                                    <div class="media-body">
                                    <small class="mt-0">{{ $jawabkomen->user->nama }}</small><br>
                                    <small title="point reputations"><i class="fas fa-award"></i>
                                        @foreach ($jawabkomen->user->voteuser as $point)
                                            {{ $point->point }}
                                        @endforeach
                                    </small> .
                                    <small>Dijawab {{ $jawabkomen->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <a href="" style="font-size: 12px;" data-toggle="modal" data-target="#komentarjawaban-{{$jawab->id}}">add a comment</a>
                        </div>
                    </div>
                @endforeach


            </div>

            <div class="mt-5">
                <h1 class="h3">Jawaban Kamu</h1>
                <form action=" {{ route('jawaban.store') }} " method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <small>Note* : Berikan jawaban yang menurut kamu paling tepat</small>
                        <textarea id="my-editor" name="isi" class="form-control" required>{!! old('isi', 'test editor content') !!}</textarea>
                        <input type="hidden" name="pertanyaan_id" value=" {{ $pertanyaan->id }} ">
                        @guest
                        <input type="hidden" name="user_id" value="">
                        @else
                        <input type="hidden" name="user_id" value=" {{ Auth::user()->id }} ">
                        @endguest
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success w-25 float-right">Post Jawaban</button>
                    </div>
                </form>
            </div>


        </div>
        <div class="col-md-4">
            <div class="card text-white mb-3">
                <div class="card-header bg-secondary">Pertanyaan Yang Sama</div>
                <div class="card-body">
                    {{-- pertanyaan yang sama --}}
                    <div class="media text-dark pb-3 border-bottom mb-3">
                        <img class="mr-3 rounded-circle" src="https://via.placeholder.com/50" alt="Generic placeholder image">
                        <div class="media-body">
                            <p class="mt-0 mb-0 font-weight-bold">Restu</p>
                            <small>12-July-2020</small><br>
                            <a href=""><small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, molestias!</small></a><br>
                            <div class="">
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">php</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">laravel</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">javascript</small>
                            </div>
                        </div>
                    </div>
                    {{-- pertanyaan yang sama --}}
                    <div class="media text-dark pb-3 border-bottom mb-3">
                        <img class="mr-3 rounded-circle" src="https://via.placeholder.com/50" alt="Generic placeholder image">
                        <div class="media-body">
                            <p class="mt-0 mb-0 font-weight-bold">Restu</p>
                            <small>12-July-2020</small><br>
                            <a href=""><small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, molestias!</small></a><br>
                            <div class="">
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">php</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">laravel</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">javascript</small>
                            </div>
                        </div>
                    </div>
                    {{-- pertanyaan yang sama --}}
                    <div class="media text-dark pb-3 border-bottom mb-3">
                        <img class="mr-3 rounded-circle" src="https://via.placeholder.com/50" alt="Generic placeholder image">
                        <div class="media-body">
                            <p class="mt-0 mb-0 font-weight-bold">Restu</p>
                            <small>12-July-2020</small><br>
                            <a href=""><small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, molestias!</small></a><br>
                            <div class="">
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">php</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">laravel</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">javascript</small>
                            </div>
                        </div>
                    </div>
                    {{-- pertanyaan yang sama --}}
                    <div class="media text-dark pb-3 border-bottom mb-3">
                        <img class="mr-3 rounded-circle" src="https://via.placeholder.com/50" alt="Generic placeholder image">
                        <div class="media-body">
                            <p class="mt-0 mb-0 font-weight-bold">Restu</p>
                            <small>12-July-2020</small><br>
                            <a href=""><small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, molestias!</small></a><br>
                            <div class="">
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">php</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">laravel</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">javascript</small>
                            </div>
                        </div>
                    </div>
                    {{-- pertanyaan yang sama --}}
                    <div class="media text-dark pb-3 border-bottom mb-3">
                        <img class="mr-3 rounded-circle" src="https://via.placeholder.com/50" alt="Generic placeholder image">
                        <div class="media-body">
                            <p class="mt-0 mb-0 font-weight-bold">Restu</p>
                            <small>12-July-2020</small><br>
                            <a href=""><small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, molestias!</small></a><br>
                            <div class="">
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">php</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">laravel</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">javascript</small>
                            </div>
                        </div>
                    </div>
                    {{-- pertanyaan yang sama --}}
                    <div class="media text-dark pb-3 border-bottom mb-3">
                        <img class="mr-3 rounded-circle" src="https://via.placeholder.com/50" alt="Generic placeholder image">
                        <div class="media-body">
                            <p class="mt-0 mb-0 font-weight-bold">Restu</p>
                            <small>12-July-2020</small><br>
                            <a href=""><small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, molestias!</small></a><br>
                            <div class="">
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">php</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">laravel</small>
                                <small class="btn btn-success btn-sm" style="font-size: 8px;">javascript</small>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <a href="" class="btn btn-link">See more &nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-alt-circle-right"></i></a>
                    </div>

                </div>
              </div>
        </div>
    </div>
</div>

<!-- Modal Komentar di Pertanyaan-->
<div class="modal fade" id="komentarpertanyaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action=" {{ route('komentar.store') }} " method="POST">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Komentar di Pertanyaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea name="isi" class="form-control" cols="30" rows="10"></textarea>
                        <small>Note* :masukan jawaban Lebih spesifik dan bayangkan Anda menerima jawaban dari pertanyaan kamu</small>
                    </div>
                    <input type="hidden" name="pertanyaan_id" value=" {{ $pertanyaan->id }} ">
                    @guest
                        <input type="hidden" name="user_id" value="">
                    @else
                        <input type="hidden" name="user_id" value=" {{ Auth::user()->id }} ">
                    @endguest
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal komentar di jawaban-->
@foreach ($pertanyaan->jawaban as $jawab)
<div class="modal fade" id="komentarjawaban-{{$jawab->id}}" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action=" {{ route('komentar.jawaban') }} " method="POST">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Komentar di jawaban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea name="isi" class="form-control" cols="30" rows="10"></textarea>
                        <small>Note* :masukan jawaban Lebih spesifik dan bayangkan Anda menerima jawaban dari pertanyaan kamu</small>
                    </div>
                    <input type="hidden" name="jawaban_id" value=" {{ $jawab->id }} ">
                    @guest
                        <input type="hidden" name="user_id" value="">
                    @else
                        <input type="hidden" name="user_id" value=" {{ Auth::user()->id }} ">
                    @endguest
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

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
