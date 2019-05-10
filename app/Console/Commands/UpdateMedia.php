<?php

namespace App\Console\Commands;

use App\InstagramAccount;
use Illuminate\Console\Command;

class UpdateMedia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:media';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update media of all registered Instagram Account.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $instagramAccounts = InstagramAccount::all();

        $result = $instagramAccounts->reduce(function (bool $result, InstagramAccount $instagramAccount) {
            return $result && $instagramAccount->updateMedia();
        }, true);

        if ($result === true) {
            $this->output->success("Success to update.");
            return 0;
        } else {
            $this->output->error("Error caused.");
            return 9;
        }
    }

}
