<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::where('status', 'active')->get();
        return view('labels.index', compact('labels'));
    }

    public function show(Label $label)
    {
        $entries = $label->entries()->with('patient.site')->get();
        return view('labels.show', compact('label', 'entries'));
    }

    public function filter(Request $request)
    {
        $labels = Label::where('status', 'active')->get();
        $selectedLabels = $request->input('labels', []);
        $entries = collect();

        if (!empty($selectedLabels)) {
            $entries = Entry::whereHas('labels', function ($q) use ($selectedLabels) {
                $q->whereIn('labels.id', $selectedLabels);
            }, '=', count($selectedLabels))
                ->with('patient.site')
                ->get();
        }

        return view('labels.filter', compact('labels', 'entries', 'selectedLabels'));
    }
}
