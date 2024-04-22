<x-app-layout>
    <x-slot name="header">

        <x-header>

            {{ __('My Questions') }}
        </x-header>

    </x-slot>

    <x-container>
        <x-form post :action="route('question.store')">
            <div class="mb-4">
                <x-textarea name="question" label="Question" placeholder="Ask me anything...">

                </x-textarea>
            </div>
            <x-btn.primary type="submit">
                Save
            </x-btn.primary>
            <x-btn.secondary type="reset">
                Cancel
            </x-btn.secondary>

        </x-form>

        <hr class="my-4 border-gray-700 border-dashed">

        <div class="dark:text-gray-400 uppercase font-bold mb-1">
            My Questions
        </div>

        <div class="dark:text-gray-400 space-y-4">
            @foreach ($questions as $item)
                <x-question :question="$item"/>
            @endforeach
        </div>
    </x-container>

</x-app-layout>
