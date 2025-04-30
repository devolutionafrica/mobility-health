<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionGroupResource;
use App\Mail\SendOTP;
use App\Models\Customer;
use App\Models\QuestionGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class RegisteredCustomerController extends Controller
{

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException|\Exception
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "lastname" => ['bail', 'required', 'string', 'max:255'],
            "firstname" => ['bail', 'required', 'string', 'max:255'],
            "birth_date" => ['bail', 'required', 'string'],
            "nationality_id" => ['bail', 'required', 'string'],
            "country_of_residence_id" => ['bail', 'required', 'string'],
            "phone_number.number" => ['bail', 'required', 'string', 'max:24'],
            "phone_number.code" => ['bail', 'required', 'string'],
            "whatsapp_number.number" => ['bail', 'nullable', 'string', 'max:24'],
            "whatsapp_number.code" => ['bail', 'nullable', 'string'],
            'email' => ['bail', 'required', 'string', 'lowercase', 'email', 'max:255'],
        ]);


        $oldCustomer = Customer::query()
            ->where("phone_number", $data["phone_number"])
            ->orWhere("email", $data["email"])
            ->orWhere("whatsapp_number", $data["whatsapp_number"])->first();


        if (!is_null($oldCustomer)) {
            if (is_null($oldCustomer->healthRecord)) {
                try {
                    Mail::to($oldCustomer->email)->send(new SendOTP($oldCustomer));
                } catch (\Exception $exception) {
                    throw ValidationException::withMessages([
                        "email" => "L'envoi de l'email a échoué. Contactez le support technique si le problème persiste.",
                    ]);
                }
                return [
                    "email" => $oldCustomer->email,
                ];
            } else {
                throw ValidationException::withMessages([
                    "email" => "Un client a été enregistré avec ces coordonnées. Contacter le support",
                ]);
            }

        }
        $customer = Customer::query()->create([
            ...$data,
            "otp" => AuthenticatedStatelessController::generateOtpData(6),
            "otp_expire" => Carbon::now()->addMinutes(10)
        ]);
       /* $customer->insuredCard()->create([
            "insured_number" => self::generateNumber(16),
            "card_number" => self::genererNumeroCarte(),
            "issue_date" => Carbon::now(),
            "expiration_date" => Carbon::now()->addMonths(11),
            "status" => 'active',
        ]);*/
        try {
            Mail::to($customer->email)->send(new SendOTP($customer));
        } catch (\Exception $exception) {
            throw new \Exception("L'envoi de l'email a échoué. Contactez le support technique si le problème persiste.");
        }
        return [
            "email" => $customer->email,
        ];
    }

    static function generateNumber(int $length = 4): string
    {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= mt_rand(0, 9);
        }
        return $otp;
    }

    static function genererNumeroCarte()
    {
        // Générer un préfixe aléatoire de 1 lettre majuscule
        $prefix = chr(mt_rand(65, 90)); // ASCII 65-90 correspond aux lettres majuscules A-Z

        // Générer 12 chiffres aléatoires
        $numbers = "";
        for ($i = 0; $i < 8; $i++) {
            $numbers .= mt_rand(0, 9);
        }

        // Générer un suffixe aléatoire de 2 lettres majuscules
        $suffix = "";
        for ($i = 0; $i < 2; $i++) {
            $suffix .= chr(mt_rand(65, 90)); // ASCII 65-90 correspond aux lettres majuscules A-Z
        }

        // Combiner les parties pour former le numéro de carte
        return $prefix . $numbers . $suffix;
    }
}
