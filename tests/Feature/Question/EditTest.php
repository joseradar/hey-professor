<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to open a question to edit', function () {
    // Arrange : prepare the data

    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create(['created_by' => $user->id]);

    // Act  : Open the question to edit

    get(route('question.edit', $question->id))->assertSuccessful();
});
