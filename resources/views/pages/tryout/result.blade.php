@extends('layout.main')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Try Out</h2>
                <a class="btn btn-xs btn-danger" href="{{$back}}">Kembali</a>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--1">
        @if ($role_id == 4)
        <div class="col-sm-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Daftar Peringkat
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Peringkat</th>
                                <th scope="col">Nama Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($worksheets as $worksheet)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$worksheet->user->name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
        @else
        <div class="col-sm-12">      
        @endif
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Try Out</h4>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ASPEK PENILAIAN</th>
                                <th class="text-center">BENAR</th>
                                <th class="text-center">SALAH</th>
                                <th class="text-center">SKOR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_skor = 0; ?>
                            @foreach ($results as $result)
                            <tr>
                                <td>{{ $result->question_type }}</td>
                                <td class="text-center">{{ $result->correct }}</td>
                                <td class="text-center">{{ $result->wrong }}</td>
                                <td class="text-right">{{ $result->skor }}</td>
                                <?php $total_skor = $total_skor + $result->skor; ?>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-center">TOTAL SKOR</td>
                                <td class="text-right">{{$total_skor}}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center">FINAL SKOR</td>
                                <td class="text-right">{{$total_skor}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
