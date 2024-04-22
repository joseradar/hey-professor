<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('should be able to like a question', function () {

    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    post(route('question.like', $question))->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => $user->id,
        'like'        => 1,
        'unlike'      => 0,
    ]);
});

it('should be able to like question only once', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->create();
    actingAs($user);

    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));
    expect($user->votes()->where('question_id', '=', $question->id)->get())->toHaveCount(1);
});

it('should be able to unlike a question', function () {

    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    post(route('question.unlike', $question))->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => $user->id,
        'like'        => 0,
        'unlike'      => 1,
    ]);
});

it('should be able to unlike question only once', function () {

    $user     = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    expect($user->votes()->where('question_id', '=', $question->id)->get())->toHaveCount(1);
});
