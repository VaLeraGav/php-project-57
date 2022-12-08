<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\Support\Facades\Auth;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::paginate(10);
        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        if (Auth::guest()) {
            return abort(403);
        }
        $label = new Label();
        return view('labels.create', compact('label'));
    }

    public function store(StoreLabelRequest $request)
    {
        if (Auth::guest()) {
            return redirect()->route('labels.index');
        }

        $data = $request->validated();
        $label = new Label();
        $label->fill($data);
        $label->save();

        flash(__('flash.label.added'))->success();
        return redirect()
            ->route('labels.index');
    }

    public function edit(Label $label)
    {
        if (Auth::guest()) {
            return abort(403);
        }
        return view('labels.edit', compact('label'));
    }

    public function update(UpdateLabelRequest $request, Label $label)
    {
        if (Auth::guest()) {
            return redirect()->route('labels.index');
        }

        $data = $request->validated();
        $label->fill($data);
        $label->save();

        flash(__('flash.label.edited'))->success();
        return redirect()
            ->route('labels.index');
    }

    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            flash(__('flash.label.failed'))->error();
            return redirect()->route('task_statuses.index');
        }

        $label->delete();
        flash(__('flash.label.deleted'))->success();
        return redirect()->route('labels.index');
    }
}
