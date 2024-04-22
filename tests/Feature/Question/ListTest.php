<?php

use App\Models\{Question, User};
use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\{actingAs, get};

it('should list all questions', function () {
    //Arrange

    $user = User::factory()->create();
    actingAs($user);

    $questions = Question::factory()->count(5)->create();

    //Act

    $response = get(route('dashboard'));

    //Assert

    /** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});

it('should paginate the result', function () {
    $user      = User::factory()->create();
    $questions = Question::factory()->count(20)->create();

    actingAs($user);

    get(route('dashboard'))->assertViewHas('questions', fn ($questions) => $questions instanceof LengthAwarePaginator && $questions->count() === 7);
});
