<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Options;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOption\Option;

class AdminController extends Controller
{
    public function index()
    {
        $total_massage_Value = Options::query()->sum('massage_therapy');
        $total_care_Value = Options::query()->sum('chiropractic_care');
        $total_yoga_Value = Options::query()->sum('yoga_exercise');
        $total_other_Value = Options::query()->sum('others');


        $option300x250 = Options::query()->where('size', 'size300x250')->first();
        $option300x600 = Options::query()->where('size', 'size300x600')->first();

        $users = User::query()->where('is_admin', false)->get()->count();

        $users300x250 = User::query()->where('is_admin', false)->where('size', 'size300x250')->get()->count();
        $users300x600 = User::query()->where('is_admin', false)->where('size', 'size300x600')->get()->count();

        return view('admin.index', [
            'total_massage_Value' => $total_massage_Value,
            'total_care_Value' => $total_care_Value,
            'total_yoga_Value' => $total_yoga_Value,
            'total_other_Value' => $total_other_Value,
            'users' => $users,

            'option300x250' => $option300x250,
            'users300x250' => $users300x250,

            'option300x600' => $option300x600,
            'users300x600' => $users300x600,

        ]);
    }
}
