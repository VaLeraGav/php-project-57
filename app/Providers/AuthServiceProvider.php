<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Task::class => \App\Policies\TaskControllerPolicy::class,
        \App\Models\Label::class => \App\Policies\LabelControllerPolicy::class,
        \App\Models\TaskStatus::class => \App\Policies\TaskStatusControllerPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
