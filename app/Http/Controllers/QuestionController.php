<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate(
            [
                'question' => ['required', 'string', 'min:10', 'ends_with:?'],
            ]
        );

        Question::query()->create(
            [
                'question' => $attributes['question'],
            ]
        );

        return redirect()->route('dashboard');
    }

    public function like(Question $question): RedirectResponse
    {
        $question->votes()->create(
            [
                'user_id' => auth()->id(),
                'like'    => 1,
                'unlike'  => 0,
            ]
        );

        return back();
    }
}
