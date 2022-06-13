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

        $massage_Value = Options::query()->value('massage_therapy');
        $care_Value = Options::query()->value('chiropractic_care');
        $yoga_Value = Options::query()->value('yoga_exercise');
        $other_Value = Options::query()->value('others');

        if ($option == 'Not concerned') :
            Options::query()->update(array('massage_therapy' => $massage_Value + 1));
        elseif ($option == 'Slightly concerned') :
            Options::query()->update(array('chiropractic_care' => $care_Value + 1));
        elseif ($option == 'Somewhat concerned') :
            Options::query()->update(array('yoga_exercise' => $yoga_Value + 1));
        elseif ($option == 'Very concerned') :
            Options::query()->update(array('others' => $other_Value + 1));
        endif;

        $total_votes = $massage_Value + $care_Value + $yoga_Value + $other_Value;

        $result = [


            'votes' => [
                ['_id' => 'not concerned', 'count' => $massage_Value],
                ['_id' => 'slightly concerned', 'count' => $care_Value],
                ['_id' => 'somewhat concerned', 'count' => $yoga_Value],
                ['_id' => 'very concerned', 'count' => $other_Value]
            ],
            'totalVotes' => $total_votes

        ];

        return $result;

    }

    public function storeUser(Request $request)
    {
        $userExist = User::query()->where('email', $request->email)->first();

        if ($userExist) :
            $userExist->update($request->all());
        else :
            $user = User::create($request->all());
        endif;

        return 'success';
    }
}
