<x-app-layout>
    <x-slot name="header">

        <x-header>

            {{ __('Dashboard') }}
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

        <hr class="mt-4 border-gray-700">

        <div class="mt-4">
            <h1 class="text-xl font-bold dark:text-gray-400 uppercase mb-1">List of Questions</h1>
        </div>

        <div class="flex flex-col space-y-4">
            @foreach ($questions as $item)
                <x-question :question="$item"/>
            @endforeach
        </div>
    </x-container>

</x-app-layout>
