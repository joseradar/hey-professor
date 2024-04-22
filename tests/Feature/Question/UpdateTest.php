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

it('should make sure that only the status Draft can be updated', function () {

    $user             = User::factory()->create();
    $questionNotDraft = Question::factory()->create(['created_by' => $user->id, 'draft' => false]);
    $draftQuestion    = Question::factory()->create(['created_by' => $user->id, 'draft' => true]);

    actingAs($user);

    put(route('question.update', $questionNotDraft->id))->assertForbidden();
    put(
        route('question.update', $draftQuestion->id),
        [
            'question' => 'This is a new question?',
        ]
    )->assertRedirect();
});

it('should make sure that only user the person who created the question can update it', function () {

    $rightUser = User::factory()->create();
    actingAs($rightUser);
    $question  = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);
    $wrongUser = User::factory()->create();

    actingAs($wrongUser);
    put(
        route('question.update', $question),
        [
            'question' => 'This is a error question?',
        ]
    )->assertForbidden();

    actingAs($rightUser);
    put(
        route('question.update', $question->id),
        [
            'question' => 'This is a new question?',
        ]
    )->assertRedirect();

});
