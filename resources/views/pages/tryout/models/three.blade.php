@extends('pages.tryout.working')

@section('models')
<div class="page-inner">
    <div class="row">
        <div class="col-sm-8">
            <div class="card bg-warning card-stats card-round">
                <div class="card-body text-center">
                    @foreach($questions as $question)
                    <button id="btn-{{$question->id}}" class="btn btn-white btn-border">{{$loop->iteration}}</button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-6">
                    <div class="card bg-warning text-white p-3">
                        <div class="row justify-content-center">
                            <h1>
                                <i style="width: 50px;" class="fas fa-clock"></i>
                            </h1>
                            <h1 id="time" style="font-weight: bold;"></h1>
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
                        <input type="hidden" id="column" name="column" value="{{ count($questions) }}">
                        <button id="btn_finish" type="submit" class="btn_finish d-none btn btn-danger">SELESAI</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach($questions as $question)
    <div class="row row-demo-grid d-none justify-content-between parent" id="{{$question->id}}">
        @for ($i = 0; $i < 5; $i++)
        <div class="col child-{{$question->id}}">
            <div class="card">
                <div class="card-header text-center bg-warning text-white">
                    <h6 id="colum" style="font-size: 20px;"><b>KOLOM {{$loop->iteration}}</b></h6>
                </div>
                <div class="text-center card-body" style="font-size: 20px; letter-spacing: 5px;">
                    {{ $question->value }}
                    <p>A B C D E</p>
                </div>
            </div>
            <?php $index = 0 + ($i * 10) ?>
            <?php $number = 1;?>
            @for ($j = $index; $j < $index+10; $j++)
            <div class="row mb-3">
                <div class="col input-group" style="width: 60px !important; padding-right: 0px !important">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            {{$number}}.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                        </div                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               >
                        <div class="form-control">
                            {{ $question->childs[$j]->value }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="selectgroup" id="options">
                        <?php $option_index = 0; ?>
                        @foreach($question->childs[$j]->options as $option)
                        <div class="selectgroup-item">
                            <input type="radio" class="selectgroup-input">
                            <span id="opt_{{$option->id}}" onclick="answer( {{$option->id}}, {{$question->childs[$j]->id}}, {{$option->skor}} )" class="selectgroup-button quest_{{$question->childs[$j]->id}}" style="width: 5px !important;">{{$option->value}}</span>
                        </div>
                        <?php $option_index++; ?>
                        @endforeach
                    </div>
                </div>
            </div>
            <?php $number++; ?>
            @endfor
        </div>
        @endfor
    </div>
    @endforeach
</div>
@endsection