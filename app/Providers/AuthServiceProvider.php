<?php

namespace App\Providers;

use App\Comment;
use App\Event;
use App\Policies\CommentPolicy;
use App\Policies\EventPolicy;
use App\Policies\PostPolicy;
use App\Policies\QuestionPolicy;
use App\Post;
use App\Question;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Event::class => EventPolicy::class,
        Comment::class => CommentPolicy::class,
        Question::class => QuestionPolicy::class,
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
