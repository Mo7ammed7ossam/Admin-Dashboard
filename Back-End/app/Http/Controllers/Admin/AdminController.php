<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Options;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $options = Options::first();
        $users = User::query()->where('is_admin', false)->get()->count();

        return view('admin.index', [
            'options' => $options,
            'users' => $users
        ]);
    }
}
