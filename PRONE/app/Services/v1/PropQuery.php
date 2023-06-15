<?php

namespace App\Services\v1;

use Illuminate\Http\Request;


class PropQuery {
    protected $safeParms = [
        'Name' => ['eq', 'like'],
        'Price' => ['eq', 'range'],
        'Bedrooms' => ['eq'],
        'Bathrooms' => ['eq'],
        'Storeys' => ['eq'],
        'Garages' => ['eq'],
    ];

    protected $columnMap =[

    ];

    protected $operatorMap =[
      'eq'=>'=',
      'lt'=>'<',
      'lte'=>'≤',
      'gt'=>'>',
      'gte'=>'≥',
        'like' => 'like',
    ];

    public function transform(Request $request){
        $eloQuery = [];

        foreach ($this->safeParms as $parm => $operators){
            $query = $request->query($parm);

            if(!isset($query)){
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator){
                if(isset($query[$operator]))
                {
                    $value = $query[$operator];

                    if ($operator === 'like') {
                        $value = '%' . $value . '%';
                    }
                    elseif ($operator === 'range')
                    {
                        $range = explode(',', $value);
                        $min = $range[0] ?? '';
                        $max = $range[1] ?? '';
                        if ($min !== '') {
                            $eloQuery[] = [$column, '>=', $min];
                        }
                        if ($max !== '') {
                            $eloQuery[] = [$column, '<=', $max];
                        }
                        continue;
                    }
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }

        }
        $price_min = $request->input('price_min');
        $price_max = $request->input('price_max');

        if ($price_min && $price_max) {
            $eloQuery[] = ['price', '>=', $price_min];
            $eloQuery[] = ['price', '<=', $price_max];
        }
        elseif ($price_min) {
            $eloQuery[] = ['price', '>=', $price_min];
        }
        elseif ($price_max) {
            $eloQuery[] = ['price', '<=', $price_max];
        }

        return $eloQuery;
    }

}
