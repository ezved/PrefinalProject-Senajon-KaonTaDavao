<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreEateryRequest extends FormRequest
{
    public function authorize(): bool
    {
        // The guide has no login requirement.
        return true;
    }

    protected function prepareForValidation(): void
    {
        // An unchecked checkbox is absent from the submitted form.
        $this->mergeIfMissing(['is_open' => false]);
    }

    public function rules(): array
    {
        // Validate the eatery, feature IDs, and permit together.
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('eateries', 'name')],
            'district_id' => ['required', 'exists:districts,id'],
            'address' => ['required', 'string', 'max:255'],
            'price_range' => ['required', 'in:budget,mid,splurge'],
            'specialty' => ['nullable', 'string', 'max:100'],
            'is_open' => ['boolean'],
            'features' => ['required', 'array', 'min:1'],
            'features.*' => ['required', 'exists:features,id'],
            'permit_no' => ['required', 'regex:/^DVO-\d{4}-\d{4,5}$/', Rule::unique('permits', 'permit_no')],
            'expires_on' => ['required', 'date', 'after:today'],
            'slug' => ['required', Rule::unique('eateries', 'slug')],
        ];
    }

    public function validationData(): array
    {
        // Validate the generated slug even when different names produce the same slug.
        $data = parent::validationData();
        $name = $data['name'] ?? null;
        $data['slug'] = is_string($name) ? Str::slug($name) : '';

        return $data;
    }

    public function messages(): array
    {
        // Show the handout's exact wording for the listed errors.
        return [
            'name.unique' => 'Kaon Ta Senajon already lists an eatery with this name.',
            'features.required' => 'Pick at least one feature.',
            'permit_no.regex' => 'Permit number must look like DVO-2026-0415.',
            'expires_on.after' => 'The permit must not be expired.',
            'slug.required' => 'Enter an eatery name that can be used in a URL.',
            'slug.unique' => 'This eatery name produces a URL already in use.',
        ];
    }
}
