<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Enums\Toast;
use App\Models\Question;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    private $table = [
        "fields" => [
            "" => "auto",
            "Groupe" => "300px",
            "Question" => "auto",
            "Action" => "150px",
        ],
        "columns" => [
            "" => [
                "className" => 'control',
                "searchable" => false,
                "orderable" => false,
                "responsivePriority" => 2,
                "targets" => 0,
            ],

            "group" => [
                "responsivePriority" => 4,
                "targets" => 1,
            ],
            "question" => [
                "targets" => 2,
            ],
            "action" => [
                "className" => 'text-right',
                "searchable" => false,
                "title" => "Action",
                "orderable" => false,
                "targets" => -1,
            ]
        ],
    ];


    /**
     * @param Request $request
     * @return Factory|View|Application|\Illuminate\Http\JsonResponse|object
     */
    public function index(Request $request)
    {


        if ($request->ajax()) {

            $search = [];

            $totalData = Question::query()->count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');

            if (empty($request->input('search.value'))) {
                $questions = Question::query()
                    ->with("questionGroup")
                    ->offset($start)
                    ->limit($limit)
                    ->get();
            } else {
                $search = $request->input('search.value');

                $questions = Question::query()
                    ->with("questionGroup")
                    ->where(function ($query) use ($search) {
                        $query->where('question', 'LIKE', "%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->get();

                $totalFiltered = Question::query()
                    ->with("questionGroup")
                    ->where(function ($query) use ($search) {
                        $query->where('question', 'LIKE', "%{$search}%");
                    })
                    ->count();
            }

            $data = [];

            if (!empty($questions)) {
                // providing a dummy id instead of database ids
                $ids = $start;

                foreach ($questions as $question) {
                    $nestedData['group'] = $question->questionGroup->title;
                    $nestedData['question'] = $question->question["label"] ;

                    $nestedData["linkHTML"] = trActions([
                        trLink(title: 'Détails <i class="ti ti-arrow-right"></i>', url: route("question.edit",["question"=>$question->id]), type: "text", color: "primary")
                    ]);

                    $data[] = $nestedData;
                }
            }

            if ($data) {
                return response()->json([
                    'draw' => intval($request->input('draw')),
                    'recordsTotal' => intval($totalData),
                    'recordsFiltered' => intval($totalFiltered),
                    'code' => 200,
                    'data' => $data,
                ]);
            } else {
                return response()->json([
                    'message' => 'Internal Server Error',
                    'code' => 500,
                    'data' => [],
                ]);
            }
        } else {
            return view('pages.questions.index', [
                "table" => $this->table,
                'totalUser' => 14,
                'verified' => 2,
                'notVerified' => 0,
                'userDuplicates' => 0,
            ]);
        }

    }


    /**
     * @return Factory|View|Application|object
     */
    public function create()
    {
        return view('pages.questions.create');
    }

    /**
     * @param QuestionRequest $request
     * @return RedirectResponse
     */
    public function store(QuestionRequest $request)
    {
        $data = $request->validated();
        $saving = [];
        if ($data["type"] == "text") {
            $saving = [
                "ref"=>Str::uuid(),
                "label" => $data["question"]["label"],
                "value" => ""
            ];
        }

        if ($data["type"] == "multiple") {
            $saving = [
                "ref"=>Str::uuid(),
                "label" => $data["question"]["label"],
                "response" => array_map(function ($item) {
                    return [
                        "ref"=>Str::uuid(),
                        "label" => $item->value,
                        "value" => "",
                    ];
                }, json_decode($data["question"]["response"]))
            ];
        }

        if ($data["type"] == "option") {
            $saving = [
                "ref"=>Str::uuid(),
                "label" => $data["question"]["label"],
                "response" => array_map(function ($item) {

                    return [
                        "ref"=>Str::uuid(),
                        "label" => $item["label"],
                        "value" => false,
                        "type" => $item["type"],
                        "result" => array_map(function ($_item) use ($item) {

                            return [
                                "ref"=>Str::uuid(),
                                "label" => $_item->value,
                                "value" => "",
                            ];
                        }, json_decode($item["response"])),
                    ];
                }, $data["question"]["response"])
            ];
        }

        Question::query()->create([
            "type" => $data['type'],
            "question_group_id" => $data['question_group_id'],
            "question" => $saving,
        ]);
        session()->flash("toast",Toast::createSuccess->value);
        return $request->input('btn') === "continue" ? redirect()->back() : redirect()->route('question.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     * @return Factory|View|Application|object
     */
    public function edit(Question $question)
    {
        return view('pages.questions.edit',[
            "question" => $question,
        ]);
    }

    /**
     * @param Request $request
     * @param Question $question
     * @return RedirectResponse
     */
    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            "question"=>"required|array",
        ]);
        $saving = [];
        if ($question->type == "text") {
            $saving = [
                "ref"=>Str::uuid(),
                "label" => $data["question"]["label"],
                "value" => ""
            ];
        }

        if ($question->type == "multiple") {
            $saving = [
                "ref"=>Str::uuid(),
                "label" => $data["question"]["label"],
                "response" => array_map(function ($item) {
                    return [
                        "ref"=>Str::uuid(),
                        "label" => $item->value,
                        "value" => "",
                    ];
                }, json_decode($data["question"]["response"]))
            ];
        }

        if ($question->type == "option") {
            $saving = [
                "ref"=>Str::uuid(),
                "label" => $data["question"]["label"],
                "response" => array_map(function ($item) {
                    return [
                        "ref"=>Str::uuid(),
                        "label" => $item["label"],
                        "value" => false,
                        "type" => $item["type"],
                        "result" => array_map(function ($_item) use ($item) {

                            return [
                                "ref"=>Str::uuid(),
                                "label" => $_item->value,
                                "value" => "",
                            ];
                        }, json_decode($item["response"])),
                    ];
                }, $data["question"]["response"])
            ];
        }

        $question->update([
            "question" => $saving,
        ]);
        session()->flash("toast",Toast::updateSuccess->value);
        return redirect()->back();
    }

    /**
     * @param Question $question
     * @return RedirectResponse
     */
    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();
        session()->flash("toast",Toast::deleteSuccess->value);
        return redirect()->route("question.index");
    }
}
