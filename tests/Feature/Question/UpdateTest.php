<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should be able to update a question', function () {
    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create(['created_by' => $user->id, 'draft' => true]);

    put(
        route('question.update', $question->id),
        [
            'question' => 'This is a new question?',
        ]
    )->assertRedirect();

    $question->refresh();

    expect($question->question)->toBe('This is a new question?');

});
