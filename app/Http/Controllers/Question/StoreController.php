<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request};

class StoreController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $attributes = $request->validate(
            [
                'question' => ['required', 'string', 'min:10', 'ends_with:?'],
            ]
        );

        Question::create(
            [
                'question' => $attributes['question'],
                'draft'    => true,
            ]
        );

        return redirect()->route('dashboard');
    }
}
