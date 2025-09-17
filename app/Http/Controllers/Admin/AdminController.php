<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $totalUsers = User::count();
        $totalQuestions = Question::count();
        $totalAnswers = Answer::count();


        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalQuestions' => $totalQuestions,
            'totalAnswers' => $totalAnswers,
        ]);
    }

    public function logs(Request $request)
    {



        return view('admin.logs');
    }

    public function questions(Request $request)
    {

        return view('admin.questions');
    }

    public function users(Request $request)
    {
        $users = User::latest()->paginate(15);

        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function tags(Request $request)
    {

        return view('admin.tags');
    }
}
