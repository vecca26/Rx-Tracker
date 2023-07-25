<?php

namespace App\Providers;

use App\Models\NotificationsModel;
use App\Models\TeamsModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::user()) {
                $user_id = Auth::user()->id;
                $team_id = Auth::user()->team_id;
                $notification = NotificationsModel::where('user_id', $user_id)->count();
                $user = DB::table('users')->leftJoin('professional_details', 'professional_details.user_id', '=', 'users.id')->where('users.id', $user_id)->first();
                $team = TeamsModel::where('id', $team_id)->first();
                $view->with('user', $user)
                    ->with('notification', $notification)
                    ->with('team', $team);
            } else {
                $user = "";
                $notification = 0;
                $team = "";
                $view->with('user', $user)
                    ->with('notification', $notification)
                    ->with('team', $team);
            }

            // 'data' is value to be used in views 'data' = $data
        });
    }
}
