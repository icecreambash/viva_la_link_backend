<?php

namespace App\Traits\Tools\AirImport;

use Illuminate\Support\Str;

trait StopTrait
{
    protected array $stops = [
        "non-stop" => 0,
        "1-stop" => 1,
        "2+-stop" => 2,
        "1-stop Via PAT" => 1,
        "1-stop Via Bhubaneswar" => 1,
        "1-stop Via IXU" => 1,
        "1-stop Via IDR" => 1,
        "1-stop Via MYQ" => 1,
        "1-stop Via Indore" => 1,
        "1-stop Via JRG" => 1,
        "1-stop Via Delhi" => 1,
        "1-stop Via KLH" => 1,
        "1-stop Via Hyderabad" => 1,
        "1-stop Via Patna" => 1,
        "1-stop Via Nagpur" => 1,
        "1-stop Via Ranchi" => 1,
        "1-stop Via IXE" => 1,
        "1-stop Via NAG" => 1,
        "1-stop Via JGB" => 1,
        "1-stop Via STV" => 1,
        "1-stop Via Raipur" => 1,
        "1-stop Via Mysore" => 1,
        "1-stop Via Mumbai" => 1,
        "1-stop Via GAU" => 1,
        "1-stop Via GAY" => 1,
        "1-stop Via Surat" => 1,
        "1-stop Via RPR" => 1,
        "1-stop Via VTZ" => 1,
        "1-stop Via Mangalore" => 1,
        "1-stop Via Vishakhapatnam" => 1,
        "1-stop Via IXR" => 1,
        "1-stop Via Chennai" => 1,
        "1-stop Via Guwahati" => 1,
        "1-stop Via GOP" => 1,
        "1-stop Via Kolkata" => 1,
        "1-stop Via NDC" => 1,
        "1-stop Via BBI" => 1,
        "1-stop Via Kolhapur" => 1,
        "1-stop Via Lucknow" => 1,
        "1-stop Via HYD" => 1,
    ];


    public function __construct()
    {
        foreach ($this->stops as $key => $value)
        {
            unset($this->stops[$key]);
            $this->stops[str_replace(' ','',Str::lower($key))] = $value;
        }
    }

    public function getRealStop($val)
    {
        if(array_key_exists($val,$this->stops))
        {
            return $this->stops[$val];
        }

        return 0;
    }

}
