<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator; // Tambahkan ini
use Illuminate\Support\Facades\Hash;

class MasterAdminController extends Controller
{
    public function index()
    {
        // Ambil semua data admin dan master_data, kecuali user yang saat ini login
        $admins = User::whereIn('role', ['admin', 'master_data'])
                      ->where('id', '!=', auth()->id()); // Kecualikan user yang saat ini login

        // Cek apakah request menggunakan AJAX untuk DataTables
        if (request()->ajax()) {
            return DataTables::of($admins)
                ->addIndexColumn() // Menambahkan kolom index
                ->make(true); // Mengembalikan response JSON ke DataTables
        }

        return view('masterdata.masterAdmin'); // Mengembalikan view untuk menampilkan data
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'role' => 'required|in:admin,customer,master_data'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User berhasil ditambahkan!'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ]);
    }


    // Update method to handle the form submission
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,'.$id,
                'role' => 'required|in:admin,user,master_data',
                'password' => 'nullable|min:8'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            // Update password hanya jika diisi
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return response()->json([
                'message' => 'Admin berhasil diupdate',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            // Log error untuk debugging
            // \Log::error('Update Admin Error: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function destroy($id)
    {
        try {
            $admin = User::findOrFail($id);
            $admin->delete();

            return response()->json([
                'message' => 'Admin berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus admin.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}
