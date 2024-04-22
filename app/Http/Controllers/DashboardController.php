<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $questions = Question::withSum('votes', 'like')->withSum('votes', 'unlike')->paginate(7);

        return view('dashboard', compact('questions'));
    }
}
