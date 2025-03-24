<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        $this->registerPolicies();

        Gate::define('manage-users', function ($user, $targetUser) {
            // Root (privilege=0) can manage all users
            if ($user->privilege == 0) {
                return true;
            }

            // Admins (privilege=1) can only manage moderators (privilege=2)
            return $user->privilege == 1 && $targetUser->privilege == 2;
        });
    }
}
