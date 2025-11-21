<?php

namespace App\Http\Controllers;

use App\Enums\AlertEnum;
use App\Models\User;
use Cache;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $page = $request->query('page', 1);

        $users = Cache::remember(
            'users_' . md5($search) . '_page_' . $page,
            30,
            fn() => User::when($search, function ($query, $search) {
                $query->where('nip', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            })
                ->orderBy('name', 'asc') // Ordered by name as requested
                ->paginate(10)
        );
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nip' => [
                'required',
                'string',
                'max:255',
                // NIP must be unique in the users table
                Rule::unique('users', 'nip'),
            ],
            'name' => 'required|string|max:255',
            'division' => [
                'required', // or 'nullable' if you want it optional
                'string',
                Rule::in(['marketing', 'it']), // Enforces only these two values
            ],
            'role' => 'required|in:admin,user',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Create the User
        $user = User::create([
            'nip' => $validatedData['nip'],
            'name' => $validatedData['name'],
            'division' => $validatedData['division'] ?? null,
            'role' => $validatedData['role'],
            // Hash the password before saving it to the database
            'password' => Hash::make($validatedData['password']),
            // NOTE: If your User model requires an 'email' field but you aren't collecting it,
            // you might need to supply a placeholder value here (e.g., 'nip@example.com').
            // Since you removed the input, I assume email is optional or auto-generated/not needed.
        ]);

        // 3. Clear cache
        // NOTE: Cache::flush() clears *all* application cache, which might be overkill.
        Cache::flush();

        // 4. Redirect with success message
        return redirect()->route('users.index')->with([
            'alert' => 'Pengguna ' . $user->name . ' berhasil ditambahkan!',
            'type' => AlertEnum::SUCCESS->value
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Find the user
        $user = User::findOrFail($id);

        // 2. Define Validation Rules
        $rules = [
            'nip' => [
                'required',
                'string',
                'max:255',
                // Ensure the NIP is unique, ignoring the current user's NIP
                Rule::unique('users')->ignore($user->id),
            ],
            'name' => 'required|string|max:255',
            'division' => [
                'required', // or 'nullable' if you want it optional
                'string',
                Rule::in(['marketing', 'it']), // Enforces only these two values
            ],
            'role' => 'required|in:admin,user',
            // Password is optional for updates. Only validate if a new password is provided.
            'password' => 'nullable|string|min:8|confirmed',
        ];

        // 3. Validate the request
        $validatedData = $request->validate($rules);

        // 4. Handle Data Update

        // Update non-password fields
        $user->nip = $validatedData['nip'];
        $user->name = $validatedData['name'];
        $user->division = $validatedData['division'] ?? null;
        $user->role = $validatedData['role'];

        // Check if a new password was provided and hash it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the changes
        $user->save();

        // Clear cache (use Cache::flush() only if necessary, Cache::forget() specific keys is better)
        Cache::flush();

        // 5. Redirect with success message
        return redirect()->route('users.index')->with([
            'alert' => 'Pengguna **' . $user->name . '** berhasil diperbarui!',
            'type' => AlertEnum::SUCCESS->value
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // 1. Check if the user has the 'admin' role
        // This is a common way to check, assuming your User model has an 'is_admin' column.
        // Adjust the condition based on how roles are managed in your application (e.g., $user->role === 'admin' or $user->hasRole('admin')).
        if ($user->role === 'admin') {
            return redirect()->route('users.index')->with([
                'alert' => 'Pengguna dengan peran Admin tidak dapat dihapus.',
                'type' => AlertEnum::DANGER->value // Assuming you have an ERROR type
            ]);
        }

        $user->delete();
        Cache::flush();

        return redirect()->route('users.index')->with([
            'alert' => 'Pengguna berhasil dihapus!',
            'type' => AlertEnum::SUCCESS->value
        ]);
    }
}
