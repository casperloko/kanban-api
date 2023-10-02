<?php

namespace App\Services\User;

use App\DTO\UserChangePasswordDTO;
use App\DTO\UserRegisterDTO;
use App\DTO\UserUpdateDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store(UserRegisterDTO $dto)
    {
        $isAdmin = $this->checkForUsers();

        $user = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'is_admin' => $isAdmin
        ]);

        return $user;
    }

    public function update(UserUpdateDTO $dto)
    {
        $user = User::find($dto->id);
        $user->name = $dto->name;
        $user->email = $dto->email;
        $user->save();

        return $user;
    }


    public function changePassword(UserChangePasswordDTO $dto)
    {
        $user = User::find($dto->id);

        if (!Hash::check($dto->passwordOld, $user->password)) {
            throw new ModelNotFoundException('Incorrect password', 404);
        }

        $user->password = $dto->password;
        $user->save();

        return $user;
    }

    public function delete(?int $userId)
    {
        $user = User::find($userId);

        if (empty($user)) {
            throw new ModelNotFoundException('User not found', 404);
        }

        $user->delete();
    }

    private function checkForUsers()
    {
        $users = DB::table('users')->get()->first();

        if (empty($users)) return true;

        return false;
    }
}
