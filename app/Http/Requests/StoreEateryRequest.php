<?php

// Put this class in its Laravel namespace.
namespace App\Http\Requests;

// Import FormRequest.
use Illuminate\Foundation\Http\FormRequest;
// Import Str.
use Illuminate\Support\Str;
// Import Rule.
use Illuminate\Validation\Rule;

// Define the StoreEateryRequest.
class StoreEateryRequest extends FormRequest
{
    // Define the authorize operation.
    public function authorize(): bool
    {
        // The guide has no login requirement.
        return true;
    }

    // Define the prepare for validation operation.
    protected function prepareForValidation(): void
    {
        // An unchecked checkbox is absent from the submitted form.
        $this->mergeIfMissing(['is_open' => false]);
    }

    // Define the rules operation.
    public function rules(): array
    {
        // Validate the eatery, feature IDs, and permit together.
        return [
            // Use the display name.
            'name' => ['required', 'string', 'max:100', Rule::unique('eateries', 'name')],
            // Link this record to its district.
            'district_id' => ['required', 'exists:districts,id'],
            // Use the street address.
            'address' => ['required', 'string', 'max:255'],
            // Use the selected price category.
            'price_range' => ['required', 'in:budget,mid,splurge'],
            // Use the optional specialty.
            'specialty' => ['nullable', 'string', 'max:100'],
            // Track whether this eatery accepts reviews.
            'is_open' => ['boolean'],
            // Use the selected eatery features.
            'features' => ['required', 'array', 'min:1'],
            'features.*' => ['required', 'exists:features,id'],
            // Use the permit number.
            'permit_no' => ['required', 'regex:/^DVO-\d{4}-\d{4,5}$/', Rule::unique('permits', 'permit_no')],
            // Use the date the permit expires.
            'expires_on' => ['required', 'date', 'after:today'],
            // Use the name to build the URL key.
            'slug' => ['required', Rule::unique('eateries', 'slug')],
        ];
    }

    // Define the validation data operation.
    public function validationData(): array
    {
        // Validate the generated slug even when different names produce the same slug.
        $data = parent::validationData();
        // Prepare the name value for the next step.
        $name = $data['name'] ?? null;
        $data['slug'] = is_string($name) ? Str::slug($name) : '';

        return $data;
    }

    // Define the messages operation.
    public function messages(): array
    {
        // Show the handout's exact wording for the listed errors.
        return [
            // Set the message for this validation rule.
            'name.unique' => 'Kaon Ta Senajon already lists an eatery with this name.',
            // Set the message for this validation rule.
            'features.required' => 'Pick at least one feature.',
            // Set the message for this validation rule.
            'permit_no.regex' => 'Permit number must look like DVO-2026-0415.',
            // Set the message for this validation rule.
            'expires_on.after' => 'The permit must not be expired.',
            // Set the message for this validation rule.
            'slug.required' => 'Enter an eatery name that can be used in a URL.',
            // Set the message for this validation rule.
            'slug.unique' => 'This eatery name produces a URL already in use.',
        ];
    }
}
