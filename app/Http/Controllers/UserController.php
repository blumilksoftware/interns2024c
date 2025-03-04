<?php

namespace Interns2024c\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Interns2024c\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return Response
     */
    public function index(): Response
    {
        $users = User::all();
        return Inertia::render('User/Index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('User/Create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        return Inertia::render('User/Edit', ['user' => $user]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email",
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
