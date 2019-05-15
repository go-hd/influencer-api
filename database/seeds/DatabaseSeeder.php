<?php

use App\InstagramAccount;
use App\Medium;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $users = $this->userFactory();

        foreach ($users as $user) {
            $instagramAccounts = $this->instagramAccountFactory($user->id);

            foreach ($instagramAccounts as $instagramAccount) {
                $this->mediaFactory($instagramAccount->id);
            }
        }
    }

    /**
     * Create fake data of users.
     *
     * @return \App\User[]
     */
    protected function userFactory()
    {
        return factory(User::class, 10)->create();
    }

    /**
     * Create fake data of Instagram accounts.
     *
     * @param int $user_id
     * @return \App\InstagramAccount[]
     * @throws \Exception
     */
    protected function instagramAccountFactory(int $userId)
    {
        return factory(InstagramAccount::class, random_int(1, 4))->create([
            'user_id' => $userId,
        ]);
    }

    /**
     * Create fake data of media.
     *
     * @param int $instagramAccountId
     * @return \App\Medium[]
     * @throws \Exception
     */
    protected function mediaFactory(int $instagramAccountId)
    {
        return factory(Medium::class, random_int(10, 20))->create([
            'instagram_account_id' => $instagramAccountId,
        ]);
    }
}
