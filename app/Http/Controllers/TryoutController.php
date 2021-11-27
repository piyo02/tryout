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
        return view('pages.management.tryout.index');
    }

    public function show(Tryout $tryout)
    {
        $role_id = auth()->user()->role_id;
        $user_id = auth()->user()->id;

        $result = false;
        if( $role_id == 4 ){
            $result = Worksheet::where([
                ['user_id', '=', $user_id],
                ['tryout_id', '=', $tryout->id],
            ])->first();
        }

        $worksheets = Worksheet::where([
            ['tryout_id', '=', $tryout->id],
            ['status', '=', 1],
        ])->orderBy('final_value')->paginate(10);
        return view('pages.management.tryout.detail', [
            'result' => $result,
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
        if ($token) {
            $tryout = Tryout::select('id', 'collection_id', 'time')->where([
                ['token', '=', $token],
                ['date', '=', $today],
            ])->first();

            if ($tryout) {
                // ubah status tryout
                if( $tryout->status == 0 || $tryout->status == 2){
                    Tryout::where('id', $tryout->id)->update([
                        'status' => 1
                    ]);
                }

                $user_id = auth()->user()->id;

                $worksheet = Worksheet::where([
                    ['user_id', '=', $user_id],
                    ['tryout_id', '=', $tryout->id],
                ])->first();

                if ($worksheet) {
                    $request->session()->put('start_date', $worksheet->start_date);
                    $request->session()->put('end_date', $worksheet->end_date);
                    $request->session()->put('time', $tryout->time);
                    $request->session()->put('worksheet_id', $worksheet->id);

                    if ($worksheet->status) {
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

                    $parent = [];
                    $questions = Question::select('id', 'parent_id')->where('collection_id', $tryout->collection_id)->get();
                    foreach ($questions as $question) {
                        if ($tryout->collection->variation_id == 2 && $question->parent_id != NULL) {
                            StudentAnswer::create([
                                'worksheet_id' => $worksheet->id,
                                'question_id' => $question->id,
                                'skor' => 0,
                            ]);
                        } else if ($tryout->collection->variation_id == 3) {
                            if ($question->parent_id == NULL) {
                                array_push($parent, $question->id);
                            } else if (in_array($question->parent_id, $parent)) {
                                // array_push($parent, $question->id);
                                // nothing
                            } else {
                                StudentAnswer::create([
                                    'worksheet_id' => $worksheet->id,
                                    'question_id' => $question->id,
                                    'skor' => 0,
                                ]);
                            }
                        } else if ($tryout->collection->variation_id == 1) {
                            StudentAnswer::create([
                                'worksheet_id' => $worksheet->id,
                                'question_id' => $question->id,
                                'skor' => 0,
                            ]);
                        }
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

        $variation_id = $collection->variation_id;
        if ($variation_id == 1) {
            $questions = Question::where('collection_id', $collection->id)->get();
            $view = 'pages.tryout.models.one';
        } else if ($variation_id == 2) {
            $parent_quests = Question::where([
                ['collection_id', '=', $collection->id],
                ['parent_id', '=', NULL],
            ])->get();

            $questions = [];
            $i = 0;
            foreach ($parent_quests as $parent) {
                $questions[$i] = $parent;
                $childs = Question::where([
                    ['collection_id', '=', $collection->id],
                    ['parent_id', '=', $parent->id],
                ])->get();
                $questions[$i]->childs = $childs;
                $i++;
            }
            $view = 'pages.tryout.models.two';
        } else if ($variation_id == 3) {
            $columns = Question::where([
                ['collection_id', '=', $collection->id],
                ['parent_id', '=', NULL],
            ])->get();

            $questions = [];
            $i = 0;
            foreach ($columns as $column) {
                $questions[$i] = $column;
                $parents = Question::where([
                    ['collection_id', '=', $collection->id],
                    ['parent_id', '=', $column->id],
                ])->get();

                for ($j = 0; $j < count($parents); $j++) {
                    $parent = $parents[$j];
                    $childs = Question::where([
                        ['collection_id', '=', $collection->id],
                        ['parent_id', '=', $parent->id],
                    ])->get();
                    $parents[$j]->childs = $childs;
                }
                $questions[$i]->childs = $parents;
                $i++;
            }
            // dd($questions);
            $view = 'pages.tryout.models.three';
        }

        // $questions = Question::where('collection_id', $collection->id)->get();
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

            if ($value != $curr_value) {
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
                $data[$index]['correct'] = $data[$index]['correct'] + $correct;
                $data[$index]['wrong']  = $data[$index]['wrong'] + $wrong;
            }
            $total_skor = $total_skor + $skor;
        }
        if ($data) {
            ResultWorksheet::insert($data);
            Worksheet::where('id', $worksheet_id)->update([
                'status' => 1,
                'total_skor' => $total_skor,
                'final_value' => $total_skor,
            ]);

            // ubah status tryout menjadi telah dikerjakan
            $status = Worksheet::where([
                ['tryout_id', '=', $tryout_id],
                ['status', '=', 0],
                ])->get();
            if( count($status) == 0 ) {
                Tryout::where('id', $tryout_id)->update([
                    'status' => 2,
                ]);
            }
        }

        $request->session()->forget(['start_date', 'end_date', 'time', 'worksheet_id']);

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

    public function answer(Request $request)
    {
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
        if ($answer_) {
            $answer = StudentAnswer::where('id', $answer_->id)->update($data);
        } else {
            $answer = StudentAnswer::create($data);
        }

        return response()->json(['answer' => $answer]);
    }

    public function history()
    {
        $role_id = auth()->user()->role_id;
        $user_id = auth()->user()->id;

        if( $role_id == 4 ) {
            $tryouts = Tryout::select('tryouts.*', 'worksheets.id as worksheet_id', 'worksheets.user_id', 'worksheets.tryout_id')
                            ->join('worksheets', 'worksheets.tryout_id', '=', 'tryouts.id')
                            ->where('user_id', '=', $user_id)
                            ->orderBy('worksheets.id')
                            ->paginate(3);
            $table_name = 'Daftar Try Out Yang Telah Diikuti';
        } else  {
            $tryouts = Tryout::latest()->paginate(3);
            $table_name = 'Daftar Try Out';
        }
        
        return view('pages.management.tryout.history', [
            'tryouts' => $tryouts
        ]);
    }
}
