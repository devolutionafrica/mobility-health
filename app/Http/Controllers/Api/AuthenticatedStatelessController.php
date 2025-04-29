<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class AuthenticatedStatelessController extends Controller
{

    /**
     * Handle an incoming authentication request.
     * @throws ValidationException
     * @throws \Exception
     */
    public function generateOtp(Request $request): array
    {
        $data = $request->validate([
            "email" => "required|bail|string|email",
        ]);
        if ($customer = Customer::query()->where('email', $data['email'])->first()) {
            $customer->otp = $this->generateOtpData(6);
            $customer->otp_expire = Carbon::now()->addMinutes(10);
            $customer->save();
            $customer->refresh();
            try {
                Mail::to($customer->email)->sendNow(new \App\Mail\SendOTP($customer));
            } catch (TransportExceptionInterface $exception) {
                //$exception->getMessage();
                throw ValidationException::withMessages([
                    'email' => "L'envoi de l'email a échoué. Contactez le support technique si le problème persiste.",
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'email' => "Aucun compte n'est associé à cette adresse email.",
            ]);
        }
        return ['email' => $data["email"]];
    }

    /**
     * Handle an incoming authentication request.
     * @throws ValidationException
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            "otp" => "required|string|max:6",
            "device_name" => "required|string",
        ]);

        if ($customer = Customer::query()->with(['insuredCard', 'avatar','subscriptions'])->where('otp', $data['otp'])->first()) {
            if ($customer->otp_expire < Carbon::now()) {
                throw ValidationException::withMessages([
                    "otp" => "Le code de vérification que vous avez entré a expiré"
                ]);
            } else {
                $token = $customer->createToken($data["device_name"]);

                return [
                    'ref' => $customer->id,
                    'token' => $token->plainTextToken,
                    'customer' => CustomerResource::make($customer),
                ];
            }
        } else {
            throw ValidationException::withMessages([
                "otp" => "OTP invalide. Veuillez vérifier le code et réessayer."
            ]);
        }
    }


    static function generateOtpData(int $length = 4): string
    {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= mt_rand(0, 9);
        }
        return $otp;
    }
}
