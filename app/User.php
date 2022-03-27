<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $table="customers";
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permissions()
    {
        return $this->belongsToMany('App\Permission')->withTimestamps();

    }

    public function hasPermissions($permissions, $requireAll = false)
    {
        // Fetch all of the users permission slugs.
        $userPermissions = Arr::pluck($this->permissions->toArray(),'slug');

        // Create an empty array to store the required permissions that the user has.
        $hasPermissions = [];

        // Loop through all of the required permissions.
        foreach ((array) $permissions as $permission) {

            // Check if the required permission is in the userPermissions array.
            if (in_array($permission,$userPermissions)) {

                // Add the permission to the array of required permissions that the user has.
                $hasPermissions[] = $permission;
            }
        }

        // If all permissions are required, check that the user has them all.
        if ($requireAll === true) {
            return $hasPermissions == (array) $permissions;
        }

        // If all are not required, check that the user has at least 1.
        return !empty($hasPermissions);
    }
}
