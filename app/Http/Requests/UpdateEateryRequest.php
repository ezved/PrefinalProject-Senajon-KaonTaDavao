<?php

// Put this class in its Laravel namespace.
namespace App\Http\Requests;

// Import Rule.
use Illuminate\Validation\Rule;

// Define the UpdateEateryRequest.
class UpdateEateryRequest extends StoreEateryRequest
{
    // Define the authorize operation.
    public function authorize(): bool
    {
        // Editing is available from the public guide.
        return true;
    }

    // Define the rules operation.
    public function rules(): array
    {
        // Start with the creation rules and exclude this eatery and permit from uniqueness checks.
        $rules = parent::rules();
        // Prepare the eatery value for the next step.
        $eatery = $this->route('eatery');
        // Prepare the permit value for the next step.
        $permit = $eatery->permit()->first();
        $rules['name'][3] = Rule::unique('eateries', 'name')->ignore($eatery);
        $rules['slug'][1] = Rule::unique('eateries', 'slug')->ignore($eatery);

        // Run the next step only when this condition is met.
        if ($permit) {
            $rules['permit_no'][2] = Rule::unique('permits', 'permit_no')->ignore($permit);
        }

        return $rules;
    }

    // Define the messages operation.
    public function messages(): array
    {
        // Keep the same validation messages on both eatery forms.
        return parent::messages();
    }
}
