<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::paginate(10);
        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        $this->authorize('create', [self::class]);

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
        $this->authorize('update', [self::class]);

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
        $this->authorize('delete', [self::class]);

        if ($label->tasks()->exists()) {
            flash(__('flash.label.failed'))->error();
            return redirect()->route('labels.index');
        }

        $label->delete();
        flash(__('flash.label.deleted'))->success();
        return redirect()->route('labels.index');
    }
}
