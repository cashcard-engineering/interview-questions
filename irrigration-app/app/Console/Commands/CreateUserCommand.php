<?php

namespace App\Console\Commands;

use App\Models\User;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('Name of user: ');
        $user['email'] = $this->ask('Email of user: ');
        $user['password'] = $this->secret('Enter user password: ');


        $validator = Validator::make($user, [
            'name' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:' . User::class],
            'password' => ['required', Password::defaults()]
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return -1;
        }

        $newUser = User::create($user);
        if (!$newUser) {
            return 'no user created';
        }

        $this->info('User ' . $user['email'] . 'created successfully');

        return 0;
    }
}
