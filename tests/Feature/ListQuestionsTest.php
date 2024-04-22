<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should list all questions', function () {
    //Arrange

    $user = User::factory()->create();
    actingAs($user);

    $questions = Question::factory()->count(5)->create();

    //Act

    $response = get(route('dashboard'));

    //Assert

    /**@var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});
