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
                Ask
            </x-btn.primary>
            <x-btn.secondary type="reset">
                Cancel
            </x-btn.secondary>

        </x-form>
    </x-container>
</x-app-layout>
