<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Enums\UserType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\AsStringable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Stringable;

/**
 * @property string $id
 * @property Stringable $lastname
 * @property Stringable $firstname
 * @property string $email
 * @property string $phone_number
 * @property string $password
 * @property UserType $role
 * @property Carbon $email_verified_at
 * @property string|null $country
 * @property string|null $location
 * @property string|null $address
 * @property string|null $referent_doctor_specialty
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'password',
        'phone_number',
        'role',
        'gender',
        'country_id',
        'speciality_id',
        'personality',
        'location',
        'address',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'location' => 'array',
            'role' => UserType::class,
            'firstname' => AsStringable::class,
            'lastname' => AsStringable::class,
        ];
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function avatar(): MorphOne
    {
        return $this->morphOne(FileAttach::class, 'fileable');
    }
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => App::currentLocale() == "fr" ? $this->lastname->append(" ")->append($this->firstname) : $this->firstname->append(" ")->append($this->lastname),
        );
    }
}
