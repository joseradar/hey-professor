<?php

namespace App\Policies;

use App\Models\{Question, User};
use Illuminate\Auth\Access\Response;

class QuestionPolicy
{
    public function publish(User $user, Question $question): Response
    {
        return $question->createdBy()->is($user)
            ? Response::allow()
            : Response::deny('You do not own this question.');
    }

}
