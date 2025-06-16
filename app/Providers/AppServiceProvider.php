<?php

namespace App\Providers;

use App\Models\Reply;
use App\Models\User;
use App\Policies\ReplyPolicy;
use App\Policies\CommentPolicy;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });

        Builder::macro('search',function ($field, $string) {
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;            
        });
    }
}
