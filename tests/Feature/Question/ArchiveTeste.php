<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, assertDatabaseMissing, assertSoftDeleted, patch};

it('should be able to archive a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create(['draft' => true, 'created_by' => $user->id]);

    actingAs($user);

    patch(route('question.archive', $question))->assertRedirect();

    assertSoftDeleted('questions', ['id' => $question->id]);
    $question->refresh();
    expect($question->deleted_at)->not->toBeNull();
});

it('should make sure that only user the person who created the question archive it', function () {

    $rigthUser = User::factory()->create();
    actingAs($rigthUser);
    $question = Question::factory()
        ->create(
            [
                'draft'      => true,
                'created_by' => $rigthUser->id,
            ]
        );
    $wrongUser = User::factory()->create();

    actingAs($wrongUser);

    patch(route('question.archive', $question))->assertForbidden();
    assertDatabaseHas('questions', ['id' => $question->id]);

    actingAs($rigthUser);

    patch(route('question.archive', $question))->assertRedirect();
    assertDatabaseMissing('questions', ['id' => $question->id]);

});
