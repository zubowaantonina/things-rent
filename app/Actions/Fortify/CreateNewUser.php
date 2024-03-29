<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Users_info;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        //создаем пользователя и получаем его id
        $user = User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        //создаем запись в таблице users_infos
        Users_info::create([
            'user_id' => $user->id,
            'name' => $input['name'],
        ]);
        return $user;
    }
}
