<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tryout;
use App\Models\Worksheet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        
        } else {
            $tryouts = Tryout::latest()->paginate(3);
            $table_name = 'Daftar Try Out';
        }

        $total_mentor = User::where('role_id', 3)->count();
        $total_student = User::where('role_id', 4)->count();
        $tryout_active = Tryout::where('status', 1)->count();
        $tryout_finish = Tryout::where('status', 2)->count();

        $worksheet = Worksheet::all()->count();
        return view('pages.dashboard.index', [
            'total_mentor'  => $total_mentor,
            'total_student' => $total_student,
            'tryout_active' => $tryout_active,
            'tryout_finish' => $tryout_finish,
            'worksheet' => $worksheet,
            'tryouts' => $tryouts,
            'table_name' => $table_name,
        ]);
    }
}
