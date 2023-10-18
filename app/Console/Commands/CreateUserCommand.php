<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use function Laravel\Prompts\text;
use function Laravel\Prompts\password;
use function Laravel\Prompts\confirm;


class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--u|username= : Username of the newly created user.} {--e|email= : E-Mail of the newly created user.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manually creates a new home-erp user.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Enter username, if not present via command line option
        $name = $this->option('username');
        if ($name === null) {
            $name = text(
                label: 'Please enter your username.',
                required: true,
                validate: fn(string $value) => match (true) {
                    strlen($value) > 255 => 'The username must not exceed 255 characters.',
                    default => null
                }
            );
        }

        // Enter email, if not present via command line option
        $email = $this->option('email');
        if ($email === null) {
            $email = text(
                label: 'Please enter your E-Mail.',
                required: true,
                validate: fn(string $value) => match (true) {
                    strlen($value) > 255 => 'The email must not exceed 255 characters.',
                    default => null
                }
            );
        }

        // Always enter password from userinput for more security.
        $password = password(
            label: 'Please enter a new password.',
            placeholder: 'password',
            hint: 'Minimum 8 characters.',
            required: true,
            validate: fn(string $value) => match (true) {
                strlen($value) < 8 => 'The password must be at least 8 characters.',
                default => null
            }
        );
        $password_confirmation = password(
            label: 'Please confirm the password.',
            placeholder: 'password',
            required: true,
            validate: fn(string $value) => match (true) {
                $password !== $value => 'The password must match what you previously entered.',
                default => null
            }
        );

        // Verify password confirmation
        if ($password !== $password_confirmation) {
            $this->error('Incorrect password confirmation.');
            return Command::FAILURE;
        }

        $user = new \App\Models\User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        try {
            $user->saveOrFail();
        } catch (Exception $e) {
            $this->error('Failed to save user');
            return Command::FAILURE;
        }

        $this->info("Successfully registered user $name");
    }
}
