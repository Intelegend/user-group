<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GroupUser;
use Carbon\Carbon;

class UserCheckExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check_expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка времени подписки';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $groupUserCollection = GroupUser::all();
        $currentTime = Carbon::now();
        $deletedGroupUsers = [];
        $groupUserCollection->each(function(GroupUser $groupUser) use ($currentTime, &$deletedGroupUsers) {
            if($currentTime->greaterThan($groupUser->expires_at)) {
                $deletedGroupUsers = [$groupUser->id];
                $groupUser->delete();
            }
        });
        if(!empty($deletedGroupUsers)) {
            $this->info("Были удалены записи под номерами:");
            $this->info(implode(",", $deletedGroupUsers));
        } else {
            $this->info('Нечего удалять');
        }
    }
}
