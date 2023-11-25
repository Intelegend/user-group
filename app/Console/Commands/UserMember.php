<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;

class UserMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:member';

    private const ACTIVE = 1;
    private const NON_ACTIVE = 0;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда для добавляния пользователя в группу';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user_id = $this->ask('Предоставьте id пользователя');
        $group_id = $this->ask('Предоставьте id гурппы');

        $userModel = new User();
        $groupModel = new Group();
        $groupUserModel = new GroupUser();

        if(empty($user_id) && empty($group_id)) {
            $this->error("Параметр user_id или group_id является пустым");
            return 1;
        }

        try {
            $findedUser = $userModel::findOrFail($user_id);
            $findedGroup = $groupModel::findOrFail($group_id);
        } 
        catch(Exception $e) {
            throw new Exception($e->getMessage());
        }

        if($findedUser->active == self::NON_ACTIVE) {
            $findedUser->active = self::ACTIVE;
            $findedUser->save();
        }

        $groupUserModel->user_id = $findedUser->id;
        $groupUserModel->group_id = $findedGroup->id;
        $groupUserModel->save();
    }
}
