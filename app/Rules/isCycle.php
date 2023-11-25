<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class isCycle implements ValidationRule, DataAwareRule
{
    protected array $data = [];

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->data['cycle'] != 0) {
            if (empty($value)) {
                $fail("Поле должно быть заполнено");
            }
            if (!filter_var($value, FILTER_VALIDATE_INT)) {
                $fail("Поле должно быть числом");
            }
            if ($value > 100 || $value < 0) {
                $fail("Поле не должно быть меньше 0 или больше 100");
            }
        }
    }
}
