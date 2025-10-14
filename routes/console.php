<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('users:downgrade-expired')->daily();

Schedule::call(function () {
    User::where('membership', 'pro')
        ->whereDate('subscription_ends_at', '<', Carbon::now())
        ->update([
            'membership' => 'free',
            'subscription_ends_at' => null,
        ]);
})->daily();
