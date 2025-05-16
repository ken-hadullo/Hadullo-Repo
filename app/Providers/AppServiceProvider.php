<?php
namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\ReviewerRecommender;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReviewerRecommender::class, function ($app) {
            return new ReviewerRecommender();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Share notifications with specific views
        View::composer('dashboard.admin._partials.header', function ($view) {
            $user = Auth::user();
            $notifications = $user ? $user->notifications : collect(); // Fetch all notifications
            $unreadNotifications = $user ? $user->unreadNotifications : collect(); // Fetch unread notifications
            $view->with('notifications', $notifications);
            $view->with('unreadNotifications', $unreadNotifications);
        });
    }
}