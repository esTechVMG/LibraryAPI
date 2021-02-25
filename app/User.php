<?php

namespace App;
use App\Helpers\Token;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Resources\UserResource;

class User extends Authenticatable
{
    use Notifiable;
    public $resource = UserResource::class;

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
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function books(){
        return $this->hasManyThrough(Book::class,Borrow::class);
    }

    public static function by_field($key, $value)
    {
        $users = self::where($key, $value)->get();

        foreach ($users as $key => $user)
        {
            return $user;
        }
    }

    public function is_authorized(Request $request)
    {
        $token = new Token();
        $header_authorization = $request->header('Authorization');

        if (!isset($header_authorization))
        {
            return false;
        }

        $data = $token->decode($header_authorization);
        return !empty(self::by_field('email', $data->email));
    }
}
