@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Surveys</h1>
        <a href="{{ route('surveys.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Create Survey
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($surveys as $survey)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-2">{{ $survey->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ $survey->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">
                            By {{ $survey->user->username }}
                        </span>
                        <a href="{{ route('surveys.show', $survey) }}"
                            class="text-blue-600 hover:text-blue-800">
                            Take Survey →
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">No surveys available.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $surveys->links() }}
    </div>
</div>
@endsection 