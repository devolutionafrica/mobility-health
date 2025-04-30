<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\AsStringable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Stringable;
use Laravel\Sanctum\HasApiTokens;


/**
 * @property string $id
 * @property Stringable $lastname
 * @property Stringable $firstname
 * @property Carbon $birth_date
 * @property string $nationality
 * @property string $country_of_residence
 * @property array $phone_number
 * @property array $whatsapp_number
 * @property string $email
 * @property FileAttach $avatar
 * @property FileAttach $documentRecto
 * @property Carbon $avatar_refresh
 * @property string|null $document_type
 * @property string|null $document_num
 * @property string|null $document_url
 * @property string $token_api
 * @property string|null $otp
 * @property Carbon|null $otp_expire
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory, SoftDeletes, HasUlids, HasApiTokens;

    public $keyType = 'string';
    protected $fillable = [
        "lastname",
        "firstname",
        "birth_date",
        "nationality_id",
        "country_of_residence_id",
        "phone_number",
        "whatsapp_number",
        "email",

        "avatar_refresh",
        "document_type",
        "document_num",
        "gender",
        "otp_expire",
        "otp",
    ];

    public function healthRecord(): MorphOne
    {
        return $this->morphOne(HealthRecord::class, 'targetable')
            ->where([
                "status" => "active",
                "type" => "register",
            ]);
    }

    public function medicalIssues(): MorphOne
    {
        return $this->morphOne(HealthRecord::class, 'targetable')
            ->where([
                "status" => "active",
                "type" => "complementary",
            ]);
    }

    public function insuredCard(): HasOne
    {
        return $this->hasOne(InsuredCard::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }


    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'nationality_id', 'iso');
    }

    public function residence(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_of_residence_id', 'id');
    }

    public function avatar(): MorphOne
    {
        return $this
            ->morphOne(FileAttach::class, 'fileable')
            ->where("type_ref", "profile");
    }

    public function documentRecto(): MorphOne
    {
        return $this
            ->morphOne(FileAttach::class, 'fileable')
            ->where("type_ref", "recto");
    }

    public function documentVerso(): MorphOne
    {
        return $this
            ->morphOne(FileAttach::class, 'fileable')
            ->where("type_ref", "verso");
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => App::currentLocale() == "fr" ? $this->lastname->append(" ")->append($this->firstname) : $this->firstname->append(" ")->append($this->lastname),
        );
    }

    protected $casts = [
        "otp_expire" => "datetime",
        "birth_date" => "date",
        "avatar_refresh" => "datetime",
        "phone_number" => "array",
        "whatsapp_number" => "array",
        'firstname' => AsStringable::class,
        'lastname' => AsStringable::class,
    ];
}
