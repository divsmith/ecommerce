<?php namespace App\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider as UserProviderInterface;
use App\User;

class CustomUserProvider implements UserProviderInterface {

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function retrieveById($identifier)
    {
        return $this->model->find($identifier)->first();
    }

    public function retrieveByToken($identifier, $token)
    {
        return $this->model->where(['id' => $identifier, 'remember_token' => $token]);
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->setRememberToken($token);
    }

    public function retrieveByCredentials(array $credentials)
    {
        return $this->model->whereEmail($credentials['email'])->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // Validate the user with the hash function.
        return $user->getAuthPassword() == hash('sha256', 'very very salty', $credentials['password']);
    }
}