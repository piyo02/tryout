<?php

namespace App\Http\Controllers;

use App\Models\Tryout;
use App\Models\Question;
use App\Models\Variation;
use App\Models\Worksheet;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Models\StudentAnswer;
use App\Models\ResultWorksheet;

class TryoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $worksheets = 
        $tryouts = Tryout::latest()->paginate(3);
        return view('pages.management.tryout.index', [
            'tryouts' => $tryouts,
        ]);
    }

    public function show(Tryout $tryout)
    {
        $worksheets = Worksheet::where([
            ['tryout_id', '=', $tryout->id],
            ['status', '=', 1],
        ])->orderBy('final_value')->paginate(10);
        return view('pages.management.tryout.detail', [
            'tryout' => $tryout,
            'worksheets' => $worksheets,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        do {
            $token = strtoupper(\Str::random(5));
        } while (Tryout::where('token', $token)->first() instanceof Tryout);
        $validateData = $request->validate([
            'time' => 'required|numeric',
            // 'status' => 'required',
            'collection_id' => 'required',
            'date' => 'required',
        ]);
        try {
            $validateData['status'] = 0;
            $validateData['token'] = $token;
            Tryout::create($validateData);
            $status = 'success';
            $message = 'Berhasil Membuat Token';
        } catch (\Throwable $th) {
            $status = 'danger';
            $message = 'Gagal Membuat Token';
        }
        return redirect('/management/collection/token?col_id=' . $request->collection_id)->with($status, $message);
    }

    public function token(Request $request)
    {
        $today = date('Y-m-d');
        // $today = "2021-11-20";
        $token = $request->token;
        if($token) {
            $tryout = Tryout::select('id', 'collection_id', 'time')->where([
                ['token', '=', $token],
                ['date', '=', $today],
            ])->first();
            
            if( $tryout ) {
                $user_id = auth()->user()->id;

                $worksheet = Worksheet::where([
                    ['user_id', '=', $user_id],
                    ['tryout_id', '=', $tryout->id],
                ])->first();

                if( $worksheet ){
                    $request->session()->put('start_date', $worksheet->start_date);
                    $request->session()->put('end_date', $worksheet->end_date);
                    $request->session()->put('time', $tryout->time);
                    $request->session()->put('worksheet_id', $worksheet->id);

                    if( $worksheet->status ) {
                        return \redirect('tryout/result?tryout_id=' . $worksheet->tryout_id);
                    }

                } else {

                    $start_date = date('Y-m-d H:i:s');
                    
                    $data['user_id'] = $user_id;
                    $data['tryout_id'] = $tryout->id;
                    $data['start_date'] = $start_date;
                    $data['end_date'] = date('Y-m-d H:i:s', strtotime('+' . $tryout->time . ' minutes', strtotime($start_date)));
                    $data['status'] = 0;
                    $data['total_skor'] = 0;
                    $data['final_value'] = 0;

                    $request->session()->put('start_date', $data['start_date']);
                    $request->session()->put('end_date', $data['end_date']);
                    $request->session()->put('time', $tryout->time);
    
                    $worksheet = Worksheet::create($data);
                    $request->session()->put('worksheet_id', $worksheet->id);

                    $questions = Question::select('id')->where('collection_id', $tryout->collection_id)->get();
                    foreach ($questions as $question) {
                        StudentAnswer::create([
                            'worksheet_id' => $worksheet->id,
                            'question_id' => $question->id,
                            'skor' => 0,
                        ]);
                    }
                }

                return redirect('/tryout/working?col_id=' . $tryout->collection_id . '&tryout_id=' . $tryout->id);    
            }
        }
        return redirect('/tryout')->with('danger', 'Token Salah atau Kadaluarsa!!');    
    }

    public function working(Request $request)
    {
        $tryout = Tryout::where('id', $request->tryout_id)->first();
        $collection = Collection::where('id', $request->col_id)->first();
        $questions = Question::where('collection_id', $collection->id)->get();

        if($collection->variation_id == 1){
            $view = 'pages.tryout.models.one';
        } else if($collection->variation_id == 2){
            $view = 'pages.tryout.models.two';
        } else if($collection->variation_id == 3){
            $view = 'pages.tryout.models.three';
        }  

        $variation_id = $collection->variation_id;
        $questions = Question::where('collection_id', $collection->id)->get();
        $options = ['', 'A', 'B', 'C', 'D', 'E'];
        return view($view, [
            'tryout' => $tryout,
            'collection' => $collection,
            'questions' => $questions,
            'options' => $options,
        ]);
    }

    public function worksheet(Worksheet $worksheet, Request $request)
    {
        $results = ResultWorksheet::where('worksheet_id', $worksheet->id)->get();
        return view('pages.tryout.result', [
            'worksheet' => $worksheet,
            'results' => $results,
        ]);
    }

    public function finished(Request $request)
    {
        $today = date('Y-m-d H:i:s');
        $tryout_id = $request->tryout_id;
        $worksheet_id = $request->worksheet_id;
        $answers = StudentAnswer::join('questions', 'questions.id', '=', 'student_answers.question_id')
                                ->select('student_answers.*', 'questions.variation_id')
                                ->where('worksheet_id', $worksheet_id)
                                ->orderBy('questions.variation_id')
                                ->get();
        $curr_value = '';
        $index = -1;
        $total_skor = 0;

        $data = [];
        foreach ($answers as $answer) {
            $value = $answer->question->variation->value;
            $skor = $answer->skor;
            $correct = ($skor) ? 1 : 0;
            $wrong = (!$skor) ? 1 : 0;
            
            if( $value != $curr_value ) {
                $curr_value = $value;
                $index++;
               
                $data[$index] = [
                    'question_type' => $value,
                    'worksheet_id' => $worksheet_id,
                    'skor' => $skor,
                    'correct' => $correct,
                    'wrong' => $wrong,
                    'created_at' => $today,
                    'updated_at' => $today,
                ];
            } else {
                $data[$index]['skor']   = $data[$index]['skor'] + $skor;
                $data[$index]['correct']= $data[$index]['correct'] + $correct;
                $data[$index]['wrong']  = $data[$index]['wrong'] + $wrong;
            }
            $total_skor = $total_skor + $skor;
        }
        if($data){
            ResultWorksheet::insert($data);
            Worksheet::where('id', $worksheet_id)->update([
                'status' => 1,
                'total_skor' => $total_skor,
                'final_value' => $total_skor,
            ]);
        }

        $request->session()->forget(['start_date', 'end_date', 'time', 'worksheet_id']);
        $request->session()->flush();

        return \redirect('tryout/result?tryout_id=' . $tryout_id);
    }

    public function result(Request $request)
    {
        $tryout_id = $request->tryout_id;
        $user_id = auth()->user()->id;
        $worksheet = Worksheet::where([
            ['user_id', '=', $user_id],
            ['tryout_id', '=', $tryout_id],
        ])->first();
        $results = ResultWorksheet::where('worksheet_id', $worksheet->id)->get();
        return view('pages.tryout.result', [
            'worksheet' => $worksheet,
            'results' => $results,
        ]);
    }

    public function answer(Request $request) {
        $worksheet_id = $request->get('worksheet_id');
        $question_id = $request->get('question_id');
        $option_id = $request->get('option_id');
        $skor = $request->get('skor');

        $data = [
            'worksheet_id' => $worksheet_id,
            'question_id' => $question_id,
            'option_id' => $option_id,
            'skor' => $skor,
        ];

        $answer_ = StudentAnswer::where([
            ['worksheet_id', '=', $worksheet_id],
            ['question_id', '=', $question_id],
        ])->first();
        if( $answer_ ){
            $answer = StudentAnswer::where('id', $answer_->id)->update( $data );
        } else {
            $answer = StudentAnswer::create( $data );
        }

        return response()->json(['answer' => $answer]);

    }
}
