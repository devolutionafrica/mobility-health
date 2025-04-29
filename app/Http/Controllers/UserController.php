<?php

namespace App\Http\Controllers;

use App\Models\Enums\Toast;
use App\Models\Enums\UserType;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    private $table = [
        "fields" => [
            "" => "auto",
            "Nom et prénoms" => "300px",
            "Email" => "auto",
            "Vérifier" => "auto",
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

            "name" => [
                "responsivePriority" => 4,
                "targets" => 1,
            ],
            "email" => [
                "targets" => 2,
            ],
            "email_verified_at" => [
                "className" => 'text-center',
                "targets" => 3,
            ],
            "action" => [
                "className" => 'text-right',
                "searchable" => false,
                "title" => "Action",
                "orderable" => false,
                "targets" => -1,
            ]
        ]
    ];

    public function index(Request $request, UserType $type = UserType::Manager)
    {
        //dd($type);
        //dd(User::query()->latest()->first());
        if ($request->ajax()) {

            $search = [];
            $qr = $type == UserType::Admin || $type == UserType::Manager ? [UserType::Admin->value, UserType::Manager->name] : [$type->value];
            $totalData = User::query()->whereIn("role", $qr)->count();


            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');

            if (empty($request->input('search.value'))) {
                $users = User::query()
                    ->with("avatar")
                    ->whereIn("role", $qr)
                    ->offset($start)
                    ->limit($limit)
                    ->latest()
                    ->get();
            } else {
                $search = $request->input('search.value');

                $users = User::query()
                    ->with("avatar")
                    ->whereIn("role", $qr)
                    ->where(function ($query) use ($search) {
                        $query->where('lastname', 'LIKE', "%{$search}%")
                            ->orWhere('firstname', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%");
                    })
                    ->offset($start)
                    ->limit($limit)
                    ->latest()
                    ->get();

                $totalFiltered = User::query()
                    ->whereIn("role", $qr)
                    ->where(function ($query) use ($search) {
                        $query->where('lastname', 'LIKE', "%{$search}%")
                            ->orWhere('firstname', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%");
                    })
                    ->count();
            }

            $data = [];

            if (!empty($users)) {
                // providing a dummy id instead of database ids
                $ids = $start;

                foreach ($users as $user) {
                    $nestedData['name'] = profile(fullName: $user->name, path: $user->avatar == null ? null : urlGen(src: route("image.indexUrl", ["path" => $user->avatar->path]), width: 64, height: 64, fit: "contain"));
                    $nestedData['email'] = $user->email;
                    $nestedData['email_verified_at'] = !is_null($user->email_verified_at)
                        ? '<i class="ti fs-4 ti-shield-check text-success"></i>'
                        : '<i class="ti fs-4 ti-shield-x text-danger" ></i>';


                    $nestedData["linkHTML"] = trActions([
                        trLink(title: 'détails <i class="ti ti-arrow-right"></i>', url: route('user.edit', ['user' => $user->id, "type" => $type->value]), type: "text", color: "primary")
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
            return view('pages.users.index', [
                "type" => $type,
                "table" => $this->table,
                'totalUser' => 14,
                'verified' => 2,
                'notVerified' => 0,
                'userDuplicates' => 0,
            ]);
        }

    }


    public function create(UserType $type)
    {

        return view('pages.users.create', compact('type'));
    }


    /**
     * @throws ValidationException
     */
    public function store(Request $request, UserType $type)
    {

        $rules = [];
        if ($type == UserType::ReferentDoctor || $type == UserType::HealthPartner) {
            $rules = [
                'country_id' => "required|string",
                'location' => "required|array",
                'address' => "nullable|string",
                'speciality_id' => "required|string"
            ];
        }

        if ($request->input("personality") == "legal") {
            $rules["firstname"] = "nullable|string";
            $rules["personality"] = "required|string";
        } else {
            $rules["gender"] = "required|in:male,female";
            $rules["firstname"] = "required|string";
        }

        $data = $request->validate([
            'img' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
            "lastname" => "required|string",
            "email" => "required|email|lowercase|unique:users,email",
            "password" => ['required', 'confirmed', Rules\Password::defaults()],
            "phone_number" => "required|string|unique:users,phone_number",
            "role" => "required|in:manager,admin,referent-doctor,health-partner",
            ...$rules
        ]);


        if (!User::query()->where("firstname", $data["firstname"] ?? "")->where("lastname", $data["lastname"])->exists()) {
            $img = null;
            if (isset($data["img"])) {
                /**
                 * @var $img UploadedFile|null
                 */
                $img = $data["img"];
                unset($data["img"]);
            }
            $user = User::query()->create($data);

            /**
             * @var $img UploadedFile|null
             */
            if ($img) {
                @$user->avatar()->create([
                    "path" => $img->store($user->role->value),
                ]);
            }
            session()->flash("toast", Toast::createSuccess->value);
            return $request->input('btn') === "continue" ? redirect()->back() : redirect()->route('user.index', ['type' => $user->role == UserType::Admin || $user->role == UserType::Manager ? UserType::Admin->value : $user->role->value]);
        } else {
            session()->flash("toast", Toast::createDanger->value);
            throw ValidationException::withMessages([
                'firstname' => trans('validation.unique', ["attribute" => "Nom"]),
            ]);
        }
    }


    public function edit(UserType $type, User $user)
    {
        return view('pages.users.edit', [
                'user' => $user,
                'type' => $type
            ]
        );
    }

    public function update(Request $request, UserType $type, User $user)
    {
        $rules = [];
        if ($type == UserType::ReferentDoctor || $type == UserType::HealthPartner) {
            $rules = [
                'country_id' => "required|string",
                'location' => "required|array",
                'address' => "nullable|string",
                'speciality_id' => "required|string"
            ];
        }

        if ($request->input("personality") == "legal") {
            $rules["firstname"] = "nullable|string";
            $rules["personality"] = "required|string";
        } else {
            $rules["gender"] = "required|in:male,female";
            $rules["firstname"] = "required|string";
        }

        //dimensions:max_width=200,max_height=300
        $data = $request->validate([
            'img' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
            "lastname" => "required|string",
            "email" => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            "phone_number" => [
                'required',
                'string',
                'max:16',
                Rule::unique(User::class)->ignore($user->id),
            ],
            "role" => "required|in:manager,admin,referent-doctor,health-partner",
            ...$rules
        ]);
        if (isset($data["img"])) {
            /**
             * @var $img UploadedFile|null
             */
            $img = $data["img"];
            unset($data["img"]);
            $user->avatar()->delete();
            $user->avatar()->create([
                "path" => $img->store($user->role->value),
            ]);
        }

        $user->update($data);
        session()->flash("toast", Toast::updateSuccess->value);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        $type = $user->role->value;
        $user->delete();
        session()->flash("toast", Toast::deleteSuccess->value);
        return redirect()->route("user.index", ["type" => $type]);
    }


    /**
     * @param User $user
     * @return Factory|View|Application|object
     */
    public function editPassword(User $user)
    {
        return view('pages.users.password.edit', [
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function updatePassword(Request $request, User $user)
    {

        $validated = $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);
        session()->flash("toast", Toast::updateSuccess->value);
        return redirect()->route("user.edit", ["user" => $user, "type" => $user->role->value]);
    }
}
