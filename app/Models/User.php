<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['first_name', 'last_name', 'email', 'password'];

    public static function register(array $data): self
    {
        return self::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public static function updatePasswordByEmail($email, $newPassword)
    {
        $user = self::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        $user->password = Hash::make($newPassword);
        return $user->save();
    }
}
