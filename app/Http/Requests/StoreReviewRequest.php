<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Stop review submissions when the eatery is closed.
        return $this->route('eatery')->is_open;
    }

    public function rules(): array
    {
        // Check the selected reviewer, star rating, and review text.
        return [
            'user_id' => ['required', 'exists:users,id'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'body' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        // Match the required review error messages.
        return [
            'user_id.required' => 'Choose who is writing this review.',
            'rating.between' => 'Ratings go from 1 to 5 stars only.',
            'body.min' => 'Kaon Ta Senajon: reviews need at least 10 characters.',
        ];
    }
}
