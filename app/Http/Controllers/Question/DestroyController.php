<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\{RedirectResponse};
use Symfony\Component\HttpFoundation\Response;

class DestroyController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {
        user()->can('delete', $question)
            ? $question->delete()
            : abort(Response::HTTP_FORBIDDEN);

        return back();
    }
}
