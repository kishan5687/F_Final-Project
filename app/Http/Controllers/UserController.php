<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|min:4|max:50|unique:users,username',
            'full_name' => 'required|min:3|max:100',
            'password' => 'required|min:6',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $avatarName = null;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $uploadPath = public_path('uploads/avatars');

            File::ensureDirectoryExists($uploadPath);

            $avatarName = $file->hashName();

            $file->move($uploadPath, $avatarName);
        }

        DB::table('users')->insert([
            'username' => $validated['username'],
            'full_name' => $validated['full_name'],
            'password' => Hash::make($validated['password']),
            'avatar' => $avatarName,
            'created_at' => now(),
        ]);

        return redirect('/users')->with('success', 'Staff profile configured.');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            abort(404);
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            abort(404);
        }

        $validated = $request->validate([
            'full_name' => 'required|min:3|max:100',
            'avatar' => 'nullable|image|max:2048',
            'password' => 'nullable|string',
        ]);

        $avatarName = $user->avatar;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $uploadPath = public_path('uploads/avatars');

            File::ensureDirectoryExists($uploadPath);

            $avatarName = $file->hashName();

            $file->move($uploadPath, $avatarName);
        }

        $updateData = [
            'full_name' => $validated['full_name'],
            'avatar' => $avatarName,
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        DB::table('users')
            ->where('id', $id)
            ->update($updateData);

        return redirect('/users')->with('success', 'Staff account updated.');
    }

    public function delete($id)
    {
        if (session()->get('id') == $id) {
            return redirect('/users')
                ->with('error', 'Action rejected: You cannot delete your own session.');
        }

        DB::table('users')->where('id', $id)->delete();

        return redirect('/users')->with('success', 'Staff removed.');
    }
}
