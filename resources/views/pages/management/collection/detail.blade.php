@extends('layout.main')

@section('content')
<div class="panel-header bg-warning-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">{{$header}}</h2>
                <a class="btn btn-danger btn-sm ml-auto text-white" href={{ $action->back }}>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--1">
        @if (session()->has('success'))                        
            <div class="col-12">
                <div class="card bg-info py-2 px-4 text-white">
                    <b>{{ session('success') }}</b>
                </div>
            </div>
        @endif
        @if (session()->has('danger'))                        
            <div class="col-12">
                <div class="card bg-danger py-2 px-4 text-white">
                    <b>{{ session('danger') }}</b>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar Soal</h4>
                        @if ($variation_id != 1)
                        <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#add-question">
                            <i class="fa fa-plus"></i>
                            Tambah Soal
                        </button>

                        <div class="modal fade" id="add-question" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="/management/question_group" method="post">
                                        @csrf
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                Tambah</span>
                                                <span class="fw-light">
                                                    Soal
                                                </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <input id="collection_id" name="collection_id" type="hidden" value="{{ $collection_id }}" required>
                                                <input id="col_variation_id" name="col_variation_id" type="hidden" value="{{ $variation_id }}" required>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Soal</label>
                                                        <input id="question" name="question" type="text" class="form-control" placeholder="Soal *contoh: 1 2 3 4 5" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Jenis Soal (Penilaian)</label>
                                                        <select class="form-control" id="variation_id" name="variation_id">
                                                            @foreach ($variations as $variation)
                                                            <option value="{{$variation->id}}">{{$variation->value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                        <a class="btn btn-primary btn-sm ml-auto text-white" href={{ $action->create }}>
                            <i class="fa fa-plus"></i>
                            Tambah Soal
                        </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Soal</th>
                                <th scope="col">Tipe</th>
                                @if ($variation_id == 1)
                                <th scope="col">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    @if ($variation_id != 1)
                                        <td width="50%">{{ $question->value }}</td>
                                    @else
                                        @if (File::exists(storage_path("app/".$question->value)))
                                            <td width="50%">{!! Storage::disk('local')->get($question->value) !!}</td>
                                        @else
                                            <td>{{ "Soal Tidak Ada" }}</td>
                                        @endif
                                    @endif
                                    <td>{{$question->variation->value}}</td>
                                    {{-- @if ((!$question->parent_id || $question->collection->variation_id == 3) && $question->collection->variation_id != 1)
                                    <td>
                                        <a class="btn btn-default btn-sm ml-auto text-white" href="/management/question/{{$question->id}}?col_id={{$collection_id}}&parent_id={{$question->parent_id}}">
                                            <i class="fa-plus"></i>
                                            Daftar Soal
                                        </a>
                                    </td>
                                    @endif --}}
                                    @if ($variation_id == 1)
                                    <td>
                                        <a class="btn btn-primary btn-sm ml-auto text-white" href="/management/question/{{$question->id}}/edit?col_id={{$collection_id}}&parent_id={{$question->parent_id}}">
                                            <i class="fa fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        <button class="btn btn-danger btn-sm ml-auto" data-toggle="modal" data-target="#delete-question-{{$question->id}}">
                                            <i class="fa fa-trash"></i>
                                            Hapus
                                        </button>
    
                                        <div class="modal fade" id="delete-question-{{$question->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/management/question/{{$question->id}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                Hapus</span> 
                                                                <span class="fw-light">
                                                                    Soal
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="small text-danger">Menghapus Soal akan menghapus hasil kerja Siswa untuk soal ini</p>
                                                            <h4>Yakin ingin menghapus data?</h4>
                                                        </div>
                                                        <div class="modal-footer no-bd">
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                
    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <ul class="pagination pg-primary">
                        {{ $questions->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection