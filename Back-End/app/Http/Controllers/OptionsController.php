<?php

namespace App\Http\Controllers;

use App\Models\Options;
use App\Models\User;
use Illuminate\Http\Request;

class OptionsController extends Controller
{

    public function store(Request $request)
    {

        $option = $request->choosenOption;
        $size = $request->size;

        $massage_Value = Options::query()->where('size', $size)->value('massage_therapy');
        $care_Value = Options::query()->where('size', $size)->value('chiropractic_care');
        $yoga_Value = Options::query()->where('size', $size)->value('yoga_exercise');
        $other_Value = Options::query()->where('size', $size)->value('others');

        if ($option == 'Not concerned') :
            Options::query()->where('size', $size)->update(array('massage_therapy' => $massage_Value + 1));
        elseif ($option == 'Slightly concerned') :
            Options::query()->where('size', $size)->update(array('chiropractic_care' => $care_Value + 1));
        elseif ($option == 'Somewhat concerned') :
            Options::query()->where('size', $size)->update(array('yoga_exercise' => $yoga_Value + 1));
        elseif ($option == 'Very concerned') :
            Options::query()->where('size', $size)->update(array('others' => $other_Value + 1));
        endif;

        $total_massage_Value = Options::query()->sum('massage_therapy');
        $total_care_Value = Options::query()->sum('chiropractic_care');
        $total_yoga_Value = Options::query()->sum('yoga_exercise');
        $total_other_Value = Options::query()->sum('others');


        $total_votes = $total_massage_Value + $total_care_Value + $total_yoga_Value + $total_other_Value;

        $result = [


            'votes' => [
                ['_id' => 'not concerned', 'count' => $total_massage_Value],
                ['_id' => 'slightly concerned', 'count' => $total_care_Value],
                ['_id' => 'somewhat concerned', 'count' => $total_yoga_Value],
                ['_id' => 'very concerned', 'count' => $total_other_Value]
            ],
            'totalVotes' => $total_votes

        ];

        return $result;
    }

    public function storeUser(Request $request)
    {

        $user = User::create($request->all());

        return 'success';
    }
}
