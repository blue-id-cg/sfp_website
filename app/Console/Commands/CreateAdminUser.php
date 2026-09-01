<?php

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

#[Signature('app:create-admin-user
    {--name= : Nom complet}
    {--email= : Adresse email}
    {--password= : Mot de passe (sinon saisie interactive masquée)}')]
#[Description("Crée un compte administrateur pour accéder au CMS (équivalent de Django's createsuperuser)")]
class CreateAdminUser extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(UserService $users): int
    {
        $name = $this->option('name') ?: text(label: 'Nom complet', required: true);

        $email = $this->option('email') ?: text(
            label: 'Adresse email',
            required: true,
            validate: fn (string $value) => $this->emailError($value),
        );

        if ($error = $this->emailError($email)) {
            $this->components->error($error);

            return self::FAILURE;
        }

        $plainPassword = $this->option('password') ?: password(
            label: 'Mot de passe',
            required: true,
            validate: fn (string $value) => $this->passwordError($value),
        );

        if ($error = $this->passwordError($plainPassword)) {
            $this->components->error($error);

            return self::FAILURE;
        }

        $user = $users->create([
            'name' => $name,
            'email' => $email,
            'password' => $plainPassword,
            'role' => 'admin',
        ]);

        $this->components->info("Administrateur créé : {$user->email}");

        return self::SUCCESS;
    }

    private function emailError(string $value): ?string
    {
        return Validator::make(
            ['email' => $value],
            ['email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')]],
        )->errors()->first('email') ?: null;
    }

    private function passwordError(string $value): ?string
    {
        return Validator::make(
            ['password' => $value],
            ['password' => ['required', Password::defaults()]],
        )->errors()->first('password') ?: null;
    }
}
