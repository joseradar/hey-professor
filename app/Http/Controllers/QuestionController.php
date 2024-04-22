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
        $this->authorize('update', $question);

        return view('question.edit', ['question' => $question]);
    }

    public function update(Question $question): RedirectResponse
    {
        $this->authorize('update', $question);

        $attributes = request()->validate(
            [
                'question' => ['required', 'string', 'min:10', 'ends_with:?'],
            ]
        );
        $question->update([
            'question' => $attributes['question'],
        ]);

        return back();
    }

    public function destroy(Question $question): RedirectResponse
    {
        user()->can('delete', $question)
            ? $question->delete()
            : abort(Response::HTTP_FORBIDDEN);

        return back();
    }

}
