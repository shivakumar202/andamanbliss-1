<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Models\Admin;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        if (request()->is('admin/*')) {
            ResetPassword::createUrlUsing(function (Admin $user, string $token) {
                return url('admin/password/reset/' . $token . '?email=' . urlencode($user->email));
            });
        } else {
            ResetPassword::createUrlUsing(function (User $user, string $token) {
                return url('password/reset/' . $token . '?email=' . urlencode($user->email));
            });
        }
    }
}
