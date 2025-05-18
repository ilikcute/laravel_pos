<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index ()
    {
        $data = [
            'title' => 'Dashboard'
        ];

        return view('index', compact('data'));
    }

    public function users (Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->with(['role'])->paginate(10)->withQueryString();

        $data = [
            'title' => 'User',
            'users' => $users
        ];

        return view('users.index', compact('data'));
    }
}
