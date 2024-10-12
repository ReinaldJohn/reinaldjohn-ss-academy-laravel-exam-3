<?php

namespace App\Services;

use App\Models\Detail;
use App\Models\User;

class UserService
{
    public function saveUserDetails(User $user)
    {
        $fullName = $user->firstname . ' ' . substr($user->middlename, 0, 1) . '. ' . $user->lastname;
        $middleInitial = substr($user->middlename, 0, 1) . '.';
        $avatar = $user->photo ?? 'http://localhost/default-avatar.png';
        $gender = ($user->prefixname === 'Mr.') ? 'Male' : 'Female';
        Detail::updateOrCreate(
            ['user_id' => $user->id, 'key' => 'Full name'],
            ['value' => $fullName, 'type' => 'bio']
        );
        Detail::updateOrCreate(
            ['user_id' => $user->id, 'key' => 'Middle Initial'],
            ['value' => $middleInitial, 'type' => 'bio']
        );
        Detail::updateOrCreate(
            ['user_id' => $user->id, 'key' => 'Avatar'],
            ['value' => $avatar, 'type' => 'bio']
        );
        Detail::updateOrCreate(
            ['user_id' => $user->id, 'key' => 'Gender'],
            ['value' => $gender, 'type' => 'bio']
        );
    }
}