<?php
namespace App\Http\Controllers;

use App\User;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store']]);
    }

    protected function allowedAdminAction()
    {
        if (Gate::denies('admin-action')) {
            throw new AuthorizationException('This action is unauthorized');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->allowedAdminAction();
        
        $users = User::where(['deleted_at' => null])->get();

        return response()->json($users, 201);
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);
        $this->sendMailAdmin();

        return response()->json($user, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!$request->has('id')) {
            $message = 'You need to specify an user to update';
            $code = 422;
            return response()->json(['error' => $message, 'code' => $code], $code);
        }
        $user = User::find($request->id);

        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
        ];

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        if($request->hasFile('avatar')){
            $image = $request->file('avatar');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('avatars/' . $fileName);
            Image::make($request->avatar)->orientate()->fit(500)->save($path);
            $user->avatar = $path;
        }

        if ($request->has('birthday')) {
            $user->birthday = $request->birthday;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                $message = 'Only verified users can modify the admin field';
                $code = 409;
                return response()->json(['error' => $message, 'code' => $code], $code);
            }

            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            $message = 'You need to specify a different value to update';
            $code = 422;
            return response()->json(['error' => $message, 'code' => $code], $code);
        }

        $user->save();
        $this->sendMailAdmin();

        return response()->json($user, 201);
    }

    public function sendMailAdmin()
    {
        $user = User::where(['admin' => 'true'])->first();
        Mail::send([], [], function ($message) use ($user) {
          $message->to($user->email)
            ->subject("Information user have've updated!")
            ->setBody('Dear Admin!')
            ->setBody("<h1>Information user have've updated!</h1>", 'text/html');
        });
    }
}
