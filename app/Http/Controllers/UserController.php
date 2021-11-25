<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth');
        //$this->middleware('UserStatus');
        $this->middleware('verified');
    }

    /**
     * @param Request $request
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request): View
    {
        $this->authorize('users.index');
        $role = $request->get('role', null);

        $search   = $request->get('search', null);

        $this->user = new User();

        return view('users.index', [
            'search' => $search,
            'users'  => $this->user
                ->role($role)
                ->search($search)
                ->paginate(15)
        ]);
    }

    /**
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('users.store');
        $roles = Role::all(['name', 'id']);

        return view('users.create', ['roles' => $roles]);
    }

    /**
     * @param UserFormRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(UserFormRequest $request): RedirectResponse
    {
        $this->authorize('users.store');
        $user = new User();

        $user->name = request('name');
        $user->email = request('email');
        $user->password  = bcrypt(request('password'));
        $user->email_verified_at = now();

        $user->save();

        $user->asignarRol($request->get('rol'));

        return redirect('/users');
    }

    /**
     * @param User $user
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $user): View
    {
        $this->authorize('users.show');
        return view('users.show', compact('user'));
    }

    /**
     * @param User $user
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user): View
    {
        $this->authorize('users.store');
        $roles = Role::all(['id', 'name']);

        return view('users.edit', [
            'user'  => $user,
            'roles' => $roles
        ]);
    }

    /**
     * @param UserEditFormRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserEditFormRequest $request, User $user): RedirectResponse
    {
        $this->authorize('users.store');
        $user->update($request->all());

        $user->roles()->sync($request->get('rol'));

        return redirect('/users');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function active(user $user): RedirectResponse
    {
        $this->authorize('users.store');
        $state = $user->active;
        $user->active = !$state;

        $user->update();

        return redirect('/users');
    }
}
