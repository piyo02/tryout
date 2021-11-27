@extends('layout.main')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">{{ $header }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-12">
            <form action="{{ $action->form }}" method="post" enctype="multipart/form-data">
                @csrf
                @if ($edit)
                    @method('put')
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <a class="btn btn-danger btn-sm ml-auto text-white" href={{ $action->cancel }}>
                                Batal
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($parent_ids as $parent_id)
                            <input type="hidden" name="{{$parent_id->name}}" id="{{$parent_id->name}}" value="{{$parent_id->value}}">
                            @endforeach
                            <div class="col-sm-12 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Soal</label>
                                    <textarea id="value" name="value">
                                        {{ old('question', isset($question) ? $question_content : '') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Jenis Soal (Penilaian)</label>
                                    <select class="form-control" id="variation_id" name="variation_id">
                                        @foreach ($variations as $variation)
                                        <option {{ (isset($question) && ($question->variation_id == $variation->id)) ? 'selected' : '' }} value="{{$variation->id}}">{{$variation->value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Status</label>
                                    @if (!$edit)
                                    <input disabled type="text" class="form-control" value="Aktif" required>
                                    @else
                                    <select class="form-control" id="status" name="status">
                                        <option {{ (isset($question) && ($question->status == 1)) ? 'selected' : '' }} value="1">Aktif</option>
                                        <option {{ (isset($question) && ($question->status == 0)) ? 'selected' : '' }} value="0">Tidak Aktif</option>
                                    </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!$parent)
                <div class="card">
                    <div class="card-header">
                        <h4>Pilihan Jawaban</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Pilihan A</label>
                                    <input type="text" value="{{ (isset($options) && isset($options[0])) ? $options[0]->value : '' }}" id="option_0" name="option_0" class="form-control" placeholder="Pilihan A">
                                    <input type="hidden" value="{{ (isset($options) && isset($options[0])) ? $options[0]->id : '' }}" id="id_option_0" name="id_option_0">
                                </div>
                            </div>
                            <div class="col-sm-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Pilihan B</label>
                                    <input type="text" value="{{ (isset($options) && isset($options[1])) ? $options[1]->value : '' }}" id="option_1" name="option_1" class="form-control" placeholder="Pilihan B">
                                    <input type="hidden" value="{{ (isset($options) && isset($options[1])) ? $options[1]->id : '' }}" id="id_option_1" name="id_option_1">
                                </div>
                            </div>
                            <div class="col-sm-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Pilihan C</label>
                                    <input type="text" value="{{ (isset($options) && isset($options[2])) ? $options[2]->value : '' }}" id="option_2" name="option_2" class="form-control" placeholder="Pilihan C">
                                    <input type="hidden" value="{{ (isset($options) && isset($options[2])) ? $options[2]->id : '' }}" id="id_option_2" name="id_option_2">
                                </div>
                            </div>
                            <div class="col-sm-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Pilihan D</label>
                                    <input type="text" value="{{ (isset($options) && isset($options[3])) ? $options[3]->value : '' }}" id="option_3" name="option_3" class="form-control" placeholder="Pilihan D">
                                    <input type="hidden" value="{{ (isset($options) && isset($options[3])) ? $options[3]->id : '' }}" id="id_option_3" name="id_option_3">
                                </div>
                            </div>
                            <div class="col-sm-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Pilihan E</label>
                                    <input type="text" value="{{ (isset($options) && isset($options[4])) ? $options[4]->value : '' }}" id="option_4" name="option_4" class="form-control" placeholder="Pilihan E">
                                    <input type="hidden" value="{{ (isset($options) && isset($options[4])) ? $options[4]->id : '' }}" id="id_option_4" name="id_option_4">
                                </div>
                            </div>
                            <div class="col-sm-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Jawaban</label>
                                    <select class="form-control" id="answer" name="answer">
                                        <option {{ ((isset($options) && isset($options[0])) && $options[0]->skor) ? 'selected'  : '' }} value="option_0">Pilihan A</option>
                                        <option {{ ((isset($options) && isset($options[1])) && $options[1]->skor) ? 'selected'  : '' }} value="option_1">Pilihan B</option>
                                        <option {{ ((isset($options) && isset($options[2])) && $options[2]->skor) ? 'selected'  : '' }} value="option_2">Pilihan C</option>
                                        <option {{ ((isset($options) && isset($options[3])) && $options[3]->skor) ? 'selected'  : '' }} value="option_3">Pilihan D</option>
                                        <option {{ ((isset($options) && isset($options[4])) && $options[4]->skor) ? 'selected'  : '' }} value="option_4">Pilihan E</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-footer">
                        <div class="row">
                            <button type="submit" class="btn btn-success ml-auto">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection