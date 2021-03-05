<?php
namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Helpers\Token;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponser;

class UserController extends Controller
{
    //use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(User::all());
    }

    public function __construct()
	{
		//$this->middleware('auth')->except('store','login');
	}

	public function login(Request $request)
    {
        $user = User::by_field('email', $request->email);

		if (isset($user) && Hash::check($request->password, $user->password))
        {
            $token = new Token(['email' => $user->email]);
            $token = $token->encode();

            return response()->json([
                "token" => $token
            ], 200);
        }

        return response()->json([
            "message" => "no autorizado"
        ], 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ];

        $data = $this->transformAndValidateRequest(UserResource::class, $request, $rules);

        $data['password'] = bcrypt($data['password']);
		
		//para jwt
        $data_token = [
            "email" => $data['email'],
        ];
        $token = new Token($data_token);
        $token = $token->encode();
        $user = User::create($data);
        $this->showOne($user);
		/*return response()->json([
            "message" => "Cuenta creada con exito",
            "code" => 201,
        ], 201);*/
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->showOne($user);
    }
}
