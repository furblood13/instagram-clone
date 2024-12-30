<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::where('is_active', true)->latest()->paginate(10);
        return view('surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('surveys.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array|min:1',
            'questions.*' => 'required|string'
        ]);

        $survey = auth()->user()->surveys()->create($validated);

        return redirect()->route('surveys.show', $survey);
    }

    public function show(Survey $survey)
    {
        return view('surveys.show', compact('survey'));
    }

    public function submitResponse(Request $request, Survey $survey)
    {
        $validated = $request->validate([
            'answers' => 'required|array|min:1',
            'answers.*' => 'required|string'
        ]);

        $survey->responses()->create([
            'user_id' => auth()->id(),
            'answers' => $validated['answers']
        ]);

        return redirect()->route('surveys.index')->with('success', 'Survey completed successfully!');
    }
}
