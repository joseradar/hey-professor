<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', ['questions' => user()->questions]);
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate(
            [
                'question' => ['required', 'string', 'min:10', 'ends_with:?'],
            ]
        );

        user()->questions()->create([
            'question' => $attributes['question'],
            'draft'    => true,

        ]);

        return back();
    }

    public function edit(Question $question): View
    {
        return view('question.edit', compact('question'));
    }

    public function destroy(Question $question): RedirectResponse
    {
        user()->can('delete', $question)
            ? $question->delete()
            : abort(Response::HTTP_FORBIDDEN);

        return back();
    }
}
