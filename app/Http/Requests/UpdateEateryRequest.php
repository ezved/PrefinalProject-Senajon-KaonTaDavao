<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateEateryRequest extends StoreEateryRequest
{
    public function authorize(): bool
    {
        // Editing is available from the public guide.
        return true;
    }

    public function rules(): array
    {
        // Start with the creation rules and exclude this eatery and permit from uniqueness checks.
        $rules = parent::rules();
        $eatery = $this->route('eatery');
        $permit = $eatery->permit()->first();
        $rules['name'][3] = Rule::unique('eateries', 'name')->ignore($eatery);
        $rules['slug'][1] = Rule::unique('eateries', 'slug')->ignore($eatery);

        if ($permit) {
            $rules['permit_no'][2] = Rule::unique('permits', 'permit_no')->ignore($permit);
        }

        return $rules;
    }

    public function messages(): array
    {
        // Keep the same validation messages on both eatery forms.
        return parent::messages();
    }
}
