<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        // Fetch all users from the database
        $users = User::all();

        // Return the view with the users data
        return view('/backend.user.users', ['users' => $users]);
    }

    // User Delete
    public function delete($id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if user exists
        if ($user) {
            // Delete the user
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

}
