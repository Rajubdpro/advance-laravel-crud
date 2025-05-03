<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * List of users.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function users()
    {
        // Start building the query
        $query = User::with('user_role:id,name')->where('id', '!=', auth()->user()->id);

        // Exclude super admins if the logged-in user is not a super admin
        if (auth()->user()->role_id != UserRole::SUPER_ADMIN_ROLE) {
            $query->where('role_id', '!=', UserRole::SUPER_ADMIN_ROLE);
        }


        // Order by latest and get results
        $users = $query->latest()->get(); // equivalent to orderBy('created_at', 'desc')

//        echo "<pre>";
//        print_r($users->toArray());
//        exit();

        return view('/backend.user.users', ['users' => $users]);
    }



    /**
     * Create a new user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        // Return the view for creating a new user
        return view('/backend.user.create');
    }

    /***
     * Store a new user.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Manual validation with custom message
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'email.unique' => 'User already exists.', // 👈 your custom message
        ]);

        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create and save the user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('users.list')->with('success', 'User created successfully.');
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
    // User Edit
    public function edit($id)
    {
        // Find the user by ID
        $user = User::find($id);
        // Check if user exists
        if ($user) {
            // Return the view with the user data
            return view('/backend.user.edit', ['user' => $user]);
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    // User Update
    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // optional
        ]);

        // Find the user
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Update user data
        $user->name = $request->input('name');
        $user->email = $request->input('email');


        $user->save();
        return redirect()->route('users.list')->with('success', 'User updated successfully.');
    }


}
