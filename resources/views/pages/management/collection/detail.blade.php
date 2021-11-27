@extends('layout.main')

@section('content')
<div class="panel-header bg-primary-gradient">
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
                        <a class="btn btn-primary btn-sm ml-auto text-white" href={{ $action->create }}>
                            <i class="fa fa-plus"></i>
                            Tambah Soal
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Soal</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td width="50%">{!! Storage::disk('local')->get($question->value) !!}</td>
                                    <td>{{$question->variation->value}}</td>
                                    <td>
                                        @if ((!$question->parent_id || $question->collection->variation_id == 3) && $question->collection->variation_id != 1)
                                        <a class="btn btn-default btn-sm ml-auto text-white" href="/management/question/{{$question->id}}?col_id={{$collection_id}}&parent_id={{$question->parent_id}}">
                                            <i class="fa-plus"></i>
                                            Daftar Soal
                                        </a>
                                        @endif
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