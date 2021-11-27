<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Question;
use App\Models\Variation;
use App\Models\Collection;
use App\Observers\UserObserver;
use App\Observers\QuestionObserver;
use App\Observers\VariationObserver;
use App\Observers\CollectionObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Collection::observe(CollectionObserver::class);
        Question::observe(QuestionObserver::class);
        User::observe(UserObserver::class);
        Variation::observe(VariationObserver::class);
    }
}
