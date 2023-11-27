<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ApplicationBudgetService
{
    public function prepareDataByCategoryNameForDB(Request $request, int $budget_category_id, int $insertedId)
    {
        if(1 == $budget_category_id){
            $name = 'budget_travel';
        }elseif(2 == $budget_category_id){
            $name = 'budget_accommodation';
        }elseif(3 == $budget_category_id){
            $name = 'budget_food';
        }elseif(4 == $budget_category_id){
            $name = 'budget_fund';
        }

        $return = [];
        $i = 0;
        while (true) {
            $itemKey = $name.'_item-'.$i;
            $amountdescKey = $name.'_amount_desc-'.$i;
            $totalKey = $name.'_total-'.$i;
//dump($itemKey,$amountdescKey,$totalKey );


            if (!isset($request[$itemKey]) && !isset($request[$amountdescKey]) && !isset($request[$totalKey])) {
                break;
            }

            $col = [];
            if (isset($request[$itemKey])) {
                $col['item'] = $request[$itemKey];
            }
            if (isset($request[$amountdescKey])) {
                $col['amount_description'] = $request[$amountdescKey];
            }
            if (isset($request[$totalKey])) {
                $col['total'] = $request[$totalKey];
            }
            $col['application_id'] = $insertedId;
            $col['created_at'] = Carbon::now();
            $col['budget_category_id'] = $budget_category_id;

            $return[] = $col;
            $i++;
        }

        return $return;
    }
}
