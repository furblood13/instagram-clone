@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Create New Survey</h1>

        <form method="POST" action="{{ route('surveys.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    value="{{ old('title') }}">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Questions</label>
                <div id="questions-container" class="space-y-4">
                    <div class="flex gap-2">
                        <input type="text" name="questions[]" required
                            class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter your question">
                        <button type="button" onclick="removeQuestion(this)"
                            class="px-3 py-2 text-red-600 hover:text-red-800">
                            Remove
                        </button>
                    </div>
                </div>
                @error('questions')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <button type="button" onclick="addQuestion()"
                    class="mt-2 text-sm text-blue-600 hover:text-blue-800">
                    + Add Question
                </button>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Create Survey
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function addQuestion() {
    const container = document.getElementById('questions-container');
    const questionDiv = document.createElement('div');
    questionDiv.className = 'flex gap-2';
    questionDiv.innerHTML = `
        <input type="text" name="questions[]" required
            class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            placeholder="Enter your question">
        <button type="button" onclick="removeQuestion(this)"
            class="px-3 py-2 text-red-600 hover:text-red-800">
            Remove
        </button>
    `;
    container.appendChild(questionDiv);
}

function removeQuestion(button) {
    const container = document.getElementById('questions-container');
    if (container.children.length > 1) {
        button.parentElement.remove();
    }
}
</script>
@endsection 