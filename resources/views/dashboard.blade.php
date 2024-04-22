<x-app-layout>
    <x-slot name="header">

        <x-header>

            {{ __('Vote for a question') }}
        </x-header>

    </x-slot>

    <x-container>
        <div class="flex flex-col space-y-4">
            @foreach ($questions as $item)
                <x-question :question="$item"/>
            @endforeach

            {{$questions->links()}}
        </div>
    </x-container>

</x-app-layout>
