<?php

namespace App\Rules;

use App\Traits\Favorite\ModelFavoriteTrait;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ModelFavoriteRule implements ValidationRule
{


    use ModelFavoriteTrait;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!array_key_exists($value,$this->favorites))
        {
            $fail("$attribute field need has (Ticket, Airline or City)");
        }
    }
}
