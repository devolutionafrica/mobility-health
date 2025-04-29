<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionGroupResource;
use App\Models\Customer;
use App\Models\QuestionGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class HealthRecordController extends Controller
{

    public function questions(): AnonymousResourceCollection
    {

        return QuestionGroupResource::collection(QuestionGroup::query()->where('question_type', '=', 'register')
            ->has('questions')->get());
    }

    public function medicalIssues(): AnonymousResourceCollection
    {
        return QuestionGroupResource::collection(QuestionGroup::query()
            ->where('question_type', '=', 'complementary')
            /*->has('questions')*/ ->get());
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "response" => ['required', 'array'],
            "type" => ['required', 'string'],
        ]);
        /**
         * @var $customer Customer
         */
        $customer = $request->user();
        if ($data["type"] === "register") {
            $healthRecord = $customer->healthRecord;
            if (!is_null($healthRecord)) {
                $healthRecord->update([
                    "status" => "inactive"
                ]);
            }
            $customer->healthRecord()->create($data);
        } else {
            $medicalIssue = $customer->medicalIssues;
            if (!is_null($medicalIssue)) {
                $medicalIssue->update([
                    "status" => "inactive"
                ]);
            }
            $customer->medicalIssues()->create($data);
        }
        return response()->noContent();
    }

}
