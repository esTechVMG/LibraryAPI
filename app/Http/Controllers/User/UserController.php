<?php
namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Helpers\Token;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(User::all());
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
        //return response()->json(['data' => $user], 201);
		return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
        ];

        $data = $this->transformAndValidateRequest(UserResource::class, $request, $rules);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->fill($data);

        if(!$user->isDirty()){
            //return response()->json(['error'=>['code' => 422, 'message' => 'please specify at least one different value' ]], 422);
            return  $this->errorResponse('please specify at least one different value', 422);
        }
        $user->save();

        //return response()->json(['data'=>$user], 200);
		return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        //return response()->json(['data' => $user], 200);
        return $this->showOne($user);
    }
    
    public function __construct()
	{
		$this->middleware('auth')->except('store','login');
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
}
