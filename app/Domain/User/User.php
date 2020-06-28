<?php

namespace App\Domain\User;

use Auth0\Login\Contract\Auth0UserRepository;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements Auth0UserRepository
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    protected  function upsertUser($profile)
    {
        return User::firstOrCreate(['sub' => $profile['sub']], [
            'email' => $profile['email'] ?? '',
            'name' => $profile['name'] ?? '',
        ]);
    }

    public function getUserByDecodedJWT(array $decodedJwt): \Illuminate\Contracts\Auth\Authenticatable
    {
        $user = $this->upsertUser((array) $jwt);
        return new Auth0JWTUser($user->getAttributes());
    }

    public function getUserByUserInfo(array $userInfo): \Illuminate\Contracts\Auth\Authenticatable
    {
        $user = $this->upsertUser( $userinfo['profile'] );
        return new Auth0User( $user->getAttributes(), $userinfo['accessToken'] );
    }

    public function getUserByIdentifier($identifier): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        // TODO: Implement getUserByIdentifier() method.
    }
}
