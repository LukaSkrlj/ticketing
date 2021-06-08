<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $users = User::query();
        $order = $request->query('order');
        $search = $request->query('search');
        $search_option = $request->query('search_option');
        $descending_order = $request->query('descending_order');

        if ($search) {

            if (!$search_option) {

                $search_option = 'name';

            }

                $users = $users->where($search_option, 'LIKE', "%{$search}%");

        }

        if($order){

            $users = $descending_order ? $users->orderByDesc($order) : $users->orderBy($order);

        }

        return view('users.index', ['users' => $users->paginate(15)->withQueryString()]);
    }

    public function create()
    {
        $this->authorize('create', User::class);
        return view('users.create', ['roles' => Role::all()]);
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);

        $validated_request = $this->validateUser($request);

        $user = User::query()->create($validated_request);

        $user->roles()->sync($request->roles);

        return redirect(route('users.index'));
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('users.show',['user'=>$user]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', [
            'roles' => Role::all(),
            'user' => User::query()->find($user->id),
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $validated_request = $this->validateUser($request);

        $user->update($validated_request);

        $user->roles()->sync($request->roles);

        return redirect($user->path());
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user = User::query()->find($user);
        $user->delete();
        return redirect('/users')->with('success', 'User is deleted');
    }

    public function validateUser(UserRequest $request){
        $request->validate([
            'image' => 'nullable|mimes:jpg,png,jpeg|max:5048',
        ]);
        $validated_request = $request->validated();

        if ($request->image) {
            $new_image_name = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $new_image_name);
            $validated_request['image_path'] = $new_image_name;
        }else{
            $validated_request['image_path'] = 'default_img.png';
        }
        return $validated_request;
    }
}
