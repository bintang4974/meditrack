<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DowngradeExpiredProUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:downgrade-expired-pro-users';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    protected $signature = 'users:downgrade-expired';
    protected $description = 'Downgrade otomatis akun Pro yang sudah lewat masa aktif';

    public function handle()
    {
        $expiredUsers = User::where('membership', 'pro')
            ->whereNotNull('subscription_ends_at')
            ->where('subscription_ends_at', '<', Carbon::now())
            ->get();

        foreach ($expiredUsers as $user) {
            $user->update(['membership' => 'expired_pro']);
            $this->info("User {$user->email} telah di-downgrade menjadi expired_pro.");
        }

        return Command::SUCCESS;
    }
}
