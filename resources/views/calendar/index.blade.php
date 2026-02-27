<x-layout>
    <x-slot:title>
        Calendar
    </x-slot:title>

    <div class="main-container">
        <div id="calendar" data-tasks='@json($tasks)' data-reflections='@json($reflections)'>
        </div>
    </div>
</x-layout>