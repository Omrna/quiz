<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\User;
use App\Models\Answer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->role;
        $data = [];
        $success = ''; // To set the success process when a user enter an answer
        if($role){ // If admin access
            return view('admin',$data);
        }else{ // If a normal user logged in

            $user_id = Auth::user()->id; // Get current user id

            // Fetch all answers if exists for the asked questions
            $answers = new Answer();
            $data['answers'] = $answers->getAnswers($user_id);

            // Fetch all questions
            $questions = new Question();
            $data['questions'] = $questions->getQuestions();

            $data['submitted_answers'] = Auth::user()->is_answered_submitted; // Check if the current user has submitted their questions
            $data['user_score'] = Auth::user()->score; // Get user score

            return view('layouts.userlayout', $data)->with('success', $success);
        }
    }
}
