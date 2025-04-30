<?php

namespace App\Http\Controllers;

use App\Models\Enums\Toast;
use App\Models\QuestionGroup;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestionGroupController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function create()
    {
        return view('pages.questions.group.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data= $request->validate([
            "question_type" => "required|string",
            "title" => "required|string",
            "page"=>"required|integer",
        ]);

        QuestionGroup::query()->create($data);
        session()->flash("toast",Toast::createSuccess->value);
        return redirect()->back();
    }

    /**
     * @param QuestionGroup $questionGroup
     * @return Factory|View|Application|object
     */
    public function edit(QuestionGroup $questionGroup)
    {
        return view('pages.questions.group.edit',[
            'questionGroup' => $questionGroup
        ]);
    }

    /**
     * @param Request $request
     * @param QuestionGroup $questionGroup
     * @return RedirectResponse
     */
    public function update(Request $request,QuestionGroup $questionGroup)
    {
        $data= $request->validate([
            "question_type" => "required|string",
            "title" => "required|string",
            "page"=>"required|integer",
        ]);
        $questionGroup->update($data);
        session()->flash("toast",Toast::updateSuccess->value);
        return redirect()->back();
    }

}
