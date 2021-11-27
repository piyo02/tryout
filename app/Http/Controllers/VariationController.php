<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variations = Variation::latest()->paginate(10);
        return view('pages.management.variation.index', [
            'variations' => $variations,
            'collection' => 'Bank Soal',
            'question' => 'Soal',
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
            'about' => 'required',
        ]);
        try {
            $validatedData['value'] = $request->value_;
            Variation::create($validatedData);
            $status = 'success';
            $message = 'Berhasil Menambahkan Tipe';
        } catch (\Exception $exception) {
            $status = 'danger';
            $message = 'Gagal Menambahkan Tipe';
        }
        return redirect('/management/variation')->with($status, $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variation $variation)
    {
        $validatedData = $request->validate([
            'about' => 'required',
        ]);
        try {
            $validatedData['value'] = $request->value_;
            Variation::where('id', $variation->id)->update($validatedData);
            $status = 'success';
            $message = 'Berhasil Mengubah Tipe';
        } catch (\Exception $exception) {
            $status = 'danger';
            $message = 'Gagal Mengubah Tipe';
        }
        return redirect('/management/variation')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variation $variation)
    {
        Variation::destroy($variation->id);
        return redirect('/management/variation')->with('success', 'Berhasil Menghapus Data');
    }
}
