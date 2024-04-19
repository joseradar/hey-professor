<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 characters', function () {
    // Arrange : prepare the data

    $user = User::factory()->create();
    actingAs($user);

    // Act  : Create a new question with more than 255 characters

    $request = post(route('question.store'), [
        'question' => str_repeat('a', 256) . '?',
        'test'     => 'test',
    ]);

    // Assert : Expect an exception

    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('a', 256) . '?',
    ]);
});

it('should check if ends with a question mark', function () {
});

it('should have at least 10 characters', function () {
});
