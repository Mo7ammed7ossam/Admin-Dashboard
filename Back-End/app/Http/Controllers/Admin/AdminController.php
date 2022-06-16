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


        $users300x250_message = User::query()->where('size', 'size300x250')->where('choosenOption', 'Not concerned')->get()->count();
        $users300x250_care = User::query()->where('size', 'size300x250')->where('choosenOption', 'Slightly concerned')->get()->count();
        $users300x250_yoga = User::query()->where('size', 'size300x250')->where('choosenOption', 'Somewhat concerned')->get()->count();
        $users300x250_other = User::query()->where('size', 'size300x250')->where('choosenOption', 'Very concerned')->get()->count();


        $users300x600_message = User::query()->where('size', 'size300x600')->where('choosenOption', 'Not concerned')->get()->count();
        $users300x600_care = User::query()->where('size', 'size300x600')->where('choosenOption', 'Slightly concerned')->get()->count();
        $users300x600_yoga = User::query()->where('size', 'size300x600')->where('choosenOption', 'Somewhat concerned')->get()->count();
        $users300x600_other = User::query()->where('size', 'size300x600')->where('choosenOption', 'Very concerned')->get()->count();


        $users = User::query()->where('is_admin', false)->get()->count();

        $users300x250 = User::query()->where('is_admin', false)->where('size', 'size300x250')->get()->count();
        $users300x600 = User::query()->where('is_admin', false)->where('size', 'size300x600')->get()->count();

        return view('admin.index', [
            'total_massage_Value' => $total_massage_Value,
            'total_care_Value' => $total_care_Value,
            'total_yoga_Value' => $total_yoga_Value,
            'total_other_Value' => $total_other_Value,
            'users' => $users,

            'users300x250' => $users300x250,
            'users300x250_message' => $users300x250_message,
            'users300x250_care' => $users300x250_care,
            'users300x250_yoga' => $users300x250_yoga,
            'users300x250_other' => $users300x250_other,

            'users300x600' => $users300x600,
            'users300x600_message' => $users300x600_message,
            'users300x600_care' => $users300x600_care,
            'users300x600_yoga' => $users300x600_yoga,
            'users300x600_other' => $users300x600_other,

        ]);
    }
}
