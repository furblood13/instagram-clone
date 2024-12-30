@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold">{{ $survey->title }}</h1>
            @if($survey->description)
                <p class="text-gray-600 mt-2">{{ $survey->description }}</p>
            @endif
            <p class="text-sm text-gray-500 mt-2">Created by {{ $survey->user->username }}</p>
        </div>

        <form method="POST" action="{{ route('surveys.response', $survey) }}" class="space-y-6">
            @csrf

            @foreach($survey->questions as $index => $question)
                <div class="border-t pt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $index + 1 }}. {{ $question }}
                    </label>
                    <textarea
                        name="answers[]"
                        required
                        rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Your answer"></textarea>
                </div>
            @endforeach

            @error('answers')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <div class="flex justify-end pt-6">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Submit Response
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 