<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Carbon;

class TicketFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    protected $camel_cased_methods = false;

    public function setup()
    {

    }

    public function from_city($fromCity)
    {
        $this->where('start_city_id', $fromCity);
    }

    public function to_city($toCity)
    {
        $this->where('end_city_id', $toCity);
    }

    public function period_start($periodStart)
    {
        $this->where('start_time', '>=', \Carbon\Carbon::parse($periodStart));
    }

    public function period_end($periodEnd)
    {
        $this->where('start_time', '<=', Carbon::parse($periodEnd));
    }

    public function price_sale(bool $priceSale)
    {
        if($priceSale)
        {
            $this->orderBy('price','ASC');
        }
    }
}
