<?php

namespace App\Models;

use App\Casts\FullName;
use App\Traits\HasGravatar;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Wildside\Userstamps\Userstamps;
use Approval\Traits\ApprovesChanges;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Mpociot\Teamwork\Traits\UserHasTeams;
use Overtrue\LaravelFollow\Traits\Follower;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Yadahan\AuthenticationLog\AuthenticationLogable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasRoles,
        UserHasTeams,
        HasGravatar,
        SoftDeletes,
        Userstamps,
        LogsActivity,
        Follower,
        AuthenticationLogable,
        ApprovesChanges;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'd_name' => FullName::class,
    ];
    protected function authorizedToApprove(\Approval\Models\Modification $mod): bool
    {
        return auth()->user()->hasRole(['Super-Admin', 'Admin']);
    }
    protected function authorizedToDisapprove(\Approval\Models\Modification $mod): bool
    {
        return auth()->user()->hasRole(['Super-Admin', 'Admin']);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->setDescriptionForEvent(fn (string $eventName) => "Employee {$eventName}")
            ->useLogName('EmployeesLog');
    }
    // Attributes
    protected function PhoneNumber(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $attributes['phone']),
        );
    }
    // Scope
    public function scopePrime(Builder $query): void
    {
        $query->where('current_team_id', 4);
    }
    public function scopePlanner(Builder $query): void
    {
        $query->where('current_team_id', 5);
    }
    public function scopeCountActive($query)
    {
        return $query->whereNotNull('email_verified_at')->count();
    }
    public function scopeCountInnactive($query)
    {
        return $query->whereNull('email_verified_at')->count();
    }
    public function scopeActive($query)
    {
        return $query->whereNotNull('email_verified_at');
    }
    public function scopeInnactive($query)
    {
        return $query->whereNull('email_verified_at');
    }
    public function primes(): HasMany
    {
        return $this->hasMany(Project::class, 'prime_id');
    }
    public function planners(): HasMany
    {
        return $this->hasMany(Project::class, 'planner_id');
    }
}
