@extends('pages.tryout.working')

@section('models')
<div class="page-inner">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-7">
                    <div class="card bg-primary text-white card-stats card-round">
                        <div class="card-body text-center">
                            <h2><b>Tes Kecerdasan</b></h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-6">
                            <div class="card bg-primary text-white px-2 pt-3 pb-3">
                                <div class="row justify-content-center">
                                    <h2 >
                                        <i style="width: 30px;" class="fas fa-clock"></i>
                                    </h2>
                                    <h2 id="time" style="font-weight: bold;"></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <form action="/tryout/finished" method="post" id="form_finish" class="form_finish">
                                @csrf
                                <input type="hidden" id="start_date" name="start_date" value="{{ session()->get('start_date') }}">
                                <input type="hidden" id="end_date" name="end_date" value="{{ session()->get('end_date') }}">
                                <input type="hidden" id="tryout_time" name="tryout_time" value="{{ session()->get('time') }}">
                                <input type="hidden" id="tryout_id" name="tryout_id" value="{{ $tryout->id }}">
                                <input type="hidden" id="variation_id" name="variation_id" value="{{ $tryout->collection->variation_id }}">
                                <input type="hidden" id="worksheet_id" name="worksheet_id" value="{{ session()->get('worksheet_id') }}">
                                <button style="text-align: center; padding-bottom: 12px !important; padding-top: 18px !important;" id="btn_finish" type="submit" class="btn_finish btn btn-primary">
                                    <h2 style="font-weight: bold;">SELESAI</h2>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($questions as $question)
    <div class="row d-none parent justify-content-center" id="{{ $question->id }}">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h6 id="colum"><b>KOLOM {{ $loop->iteration }}</b></h6>
                </div>
                <div class="text-center card-body">
                    {!! file_get_contents(storage_path('app/'.$question->value)) !!}
                </div>
            </div>
        </div>
        <?php $i = 1 ?>
        @foreach($question->childs as $child)
        <div class="col-12 child-{{$question->id}} d-none" id="{{ $child->id }}">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    {!! file_get_contents(storage_path('app/'.$child->value)) !!}
                                </div>
                                <div class="col-12">
                                    <div class="selectgroup" id="options">
                                        @foreach($child->options as $option)
                                        <div class="selectgroup-item">
                                            <input type="radio" class="selectgroup-input">
                                            <span onclick="answer( {{$option->id}}, {{$child->id}}, {{$option->skor}}, {{ ($i < count($question->childs)) ? $question->childs[$i]->id : $question->childs[$i-1]->id }}, {{ ($i == (count($question->childs)-1)) ? true : false }} )" class="selectgroup-button">{{$option->value}}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    @foreach($child->options as $option)
                                    <button onclick="answer( {{$option->id}}, {{$child->id}}, {{$option->skor}}, {{ ($i < count($question->childs)) ? $question->childs[$i]->id : $question->childs[$i-1]->id }}, {{ ($i == (count($question->childs)-1)) ? true : false }} )" class="btn btn-sm btn-border btn-default">{{ $option->value }}</button>
                                    @endforeach
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $i++ ?>
        @endforeach
    </div>
    @endforeach



</div>
@endsection