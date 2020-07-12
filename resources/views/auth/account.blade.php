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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src=" {{ asset('/images/profile/'.$user->foto) }} " alt="Card image cap" width="100%">
                    <div class="card-body">
                        <p class="card-text">Restu</p>
                        <small title="Point Kamu"><i class="fas fa-award"></i>
                            @foreach ($user->voteuser as $point)
                                {{ $point->point }}
                            @endforeach
                        </small>&nbsp;.&nbsp;
                        <small title="Point Kamu"> Question {{ $countpertanyaan }} </small>&nbsp;.&nbsp;
                        <small title="Point Kamu">Answer {{ $countjawaban }} </small>&nbsp;.&nbsp;
                        <br>
                        <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm w-50 float-right mt-5">Update Profile</a>
                    </div>
                </div>
                <ul class="list-group mt-3">
                    <a href="" data-toggle="modal" data-target="#tag"><li class="list-group-item">Tambah tag baru</li></a>
                </ul>
            </div>
            <div class="col-md-8 pl-3 border-left">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">pertanyaan</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Jawaban</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <ul class="list-unstyled text-justify">
                        @foreach ($user->pertanyaan as $tanya)
                            <li class="media mt-5 border-bottom pb-2 mb-5">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1"> {{ $tanya->judul }} </h5>
                                    <small class="mr-3">Create, {{ date('Y-F-d', strtotime($tanya->created_at)) }}</small>
                                    {{-- <small><i class="fas fa-comments"></i>
                                        @foreach ($tanya->jawaban as $jawab)
                                            {{ count($jawab) }}
                                        @endforeach
                                    </small> --}}
                                    <p class="mt-3"> {!! $tanya->isi !!} </p>
                                    @foreach ($tanya->tag as $tags)
                                        <small class="btn btn-success btn-sm" style="font-size: 10px;"> {{ $tags->nama }} </small>
                                    @endforeach
                                    <br>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    {{-- <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                          </li>
                        </ul>
                    </nav> --}}
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <ul class="list-unstyled text-justify">
                        @foreach ($user->jawaban as $jawab)
                        @php
                            $jp = $pertanyaan->where('id', $jawab->pertanyaan_id)->first();
                        @endphp
                            <li class="media mt-5 border-bottom pb-2 mb-5">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">Pertanyaan : {{ $jp->judul }} </h5>
                                    <small class="mr-3"> Pertanyaan dari,
                                        <span class="font-weight-bold">{{ $jp->user->nama }}</span>
                                    </small>
                                    <small class="mr-3">dijawab, {{ date('Y-F-d', strtotime($jawab->created_at)) }}</small><br>
                                    {{-- <small class="mr-3"><i class="fas fa-eye"></i> 100</small>
                                    <small><i class="fas fa-comments"></i> 100</small> --}}
                                    <small class="mt-3 font-weight-bold">Jawaban :</small>
                                    <p class="mt-0"> {!! $jawab->isi !!} </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                          </li>
                        </ul>
                    </nav>
                </div>
                </div>
            </div>
        </div>
    </div>

<!-- Update Profile -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action=" {{ route('account.post') }} " method="POST" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" name="nama" value="{{ $user->nama }}" class="form-control" id="staticEmail" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="staticEmail" value="{{ $user->email }}" required>
                    </div>
                </div>
                <input type="hidden" name="password" value="{{ $user->password }}">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Photo</label>
                    <div class="col-sm-10">
                    <input type="file" name="image" class="form-control" required>
                    <input type="hidden" name="current_image" value=" {{ $user->foto }} ">
                    @if (!empty($user->foto))
                        <img src="{{ asset('/images/profile/'.$user->foto) }}" alt="{{ $user->nama }}" width="50" class="mt-3">
                    @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- tambah tag -->
<div class="modal fade" id="tag" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action=" {{ route('tag.post') }} " method="POST" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Tag Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tag</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" required autofocus>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
