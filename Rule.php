<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Rules implements Rule{
  public function __construct(){

  }

  public function passes($attribute, $value)
  {
      return preg_match('/^([A-Z]{3})([0-9]{7})$/', $value);
  }

  public function message()
  {
      return 'The :attribute is invalid.';
  }
}
