<?php

namespace Modules\UserManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usermanagement::index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->id == Auth::id() && $request->role != 'admin') {
            return back()->with('error', 'Anda tidak dapat menurunkan role sendiri!');
        }

        $user->update($request->all());

        return back()->with('success', 'Data diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id == Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return back()->with('success', 'User dihapus');
    }
}
