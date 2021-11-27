<?php

namespace App\Http\Controllers;

use App\Models\Tryout;
use App\Models\Question;
use App\Models\Variation;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tryout_models = Variation::where('about', 'collection')->get();
        $collections = Collection::latest()->paginate(10);
        return view('pages.management.collection.index', [
            'collections' => $collections,
            'tryout_models' => $tryout_models,
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'variation_id' => 'required',
        ]);
        try {
            Collection::create($validatedData);
            $status = 'success';
            $message = 'Berhasil Menambahkan Bank Soal';
        } catch (\Exception $exception) {
            $status = 'danger';
            $message = 'Gagal Menambahkan Bank Soal';
        }
        return redirect('/management/collection')->with($status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        $questions = Question::where([
            ['collection_id', '=', $collection->id],
            ['parent_id', '=', NULL],
        ])->latest()->paginate(10);
        return view('pages.management.collection.detail', [
            'action' => (object) [
                'back' => "/management/collection",
                'create' => "/management/question/create?col_id=$collection->id",
            ],
            'collection_id' => $collection->id,
            'header' => "Manajemen Soal $collection->name",
            'questions' => $questions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'variation_id' => 'required',
        ]);
        try {
            Collection::where('id', $collection->id)->update($validatedData);
            $status = 'success';
            $message = 'Berhasil Mengupdate Data Bank Soal';
        } catch (\Exception $exception) {
            $status = 'danger';
            $message = 'Gagal Mengupdate Data Bank Soal';
        }
        return redirect('/management/collection')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        Collection::destroy($collection->id);
        return redirect('/management/collection')->with('success', 'Berhasil Menghapus Data');
    }

    public function token(Request $request)
    {
        if(!$request->col_id){
            return \redirect('/management/collection');
        }
        $status = [
            '<button class="btn btn-xs btn-rounded text-white btn-default">Belum Dikerjakan</button>',
            '<button class="btn btn-xs btn-rounded text-white bg-primary">Sedang Dikerjakan</button>',
            '<button class="btn btn-xs btn-rounded text-white bg-success">Sudah Dikerjakan</button>',
        ];
        $variations = Variation::where('about', 'tryout')->get();
        $tryouts = Tryout::where('collection_id', $request->col_id)->latest()->paginate(10);
        return view('pages.management.collection.token', [
            'status' => $status,
            'tryouts' => $tryouts,
            'variations' => $variations,
        ]);
    }
}
