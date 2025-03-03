<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Filament\Models\Contracts\HasName;
// use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'wmsu_email',
        'phone',     // Added phone
        'gender',    // Added gender
        'date_of_birth',  // Added date of birth
        'user_type_id',
        'wmsu_dept_id',
        'grade_level_id',
        'profile_picture',
        'wmsu_id_front',
        'wmsu_id_back',
        'is_seller',
        'seller_code',
        'is_verified',
        'verified_at',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
        ];
    }

    /**
     * Get the user's display name for Filament.
     */
    // public function getFilamentName(): string
    // {
    //     return $this->first_name ?? 'Admin'; // Use `first_name` as the display name
    // }

    // public function getFilamentName(): string
    // {
    //     return $this->getAttributeValue('first_name');
    // }

    // /**
    //  * Check if the user can access Filament.
    //  */
    // public function canAccessPanel(Panel $panel): bool
    // {
    //     return $this->is_admin; // Only allow admin users to access Filament
    // }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function department()
    {
        // Change from hasMany to belongsTo since a user belongs to a department
        return $this->belongsTo(Department::class, 'wmsu_dept_id');
    }

    public function gradeLevel(): HasMany
    {
        return $this->hasMany(GradeLevel::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function purchasedOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id'); // as buyer
    }

    public function soldOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'seller_code', 'seller_code'); // as seller
    }

    public function verification()
    {
        return $this->hasOne(UserVerification::class);
    }

    public function usernameHistory()
    {
        return $this->hasMany(UsernameHistory::class);
    }

    public function meetupLocations()
    {
        return $this->hasMany(MeetupLocation::class);
    }

    public function getDefaultMeetupLocation()
    {
        return $this->meetupLocations()
            ->where('is_active', true)
            ->where('is_default', true)
            ->first();
    }
}
