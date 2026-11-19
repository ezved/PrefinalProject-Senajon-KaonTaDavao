<?php

// Put this class in its Laravel namespace.
namespace App\Http\Requests;

// Import FormRequest.
use Illuminate\Foundation\Http\FormRequest;

// Define the StoreReviewRequest.
class StoreReviewRequest extends FormRequest
{
    // Define the authorize operation.
    public function authorize(): bool
    {
        // Stop review submissions when the eatery is closed.
        return $this->route('eatery')->is_open;
    }

    // Define the rules operation.
    public function rules(): array
    {
        // Check the selected reviewer, star rating, and review text.
        return [
            // Link the review to its writer.
            'user_id' => ['required', 'exists:users,id'],
            // Use the review rating.
            'rating' => ['required', 'integer', 'between:1,5'],
            // Use the review text.
            'body' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    // Define the messages operation.
    public function messages(): array
    {
        // Match the required review error messages.
        return [
            // Set the message for this validation rule.
            'user_id.required' => 'Choose who is writing this review.',
            // Set the message for this validation rule.
            'rating.between' => 'Ratings go from 1 to 5 stars only.',
            // Set the message for this validation rule.
            'body.min' => 'Kaon Ta Senajon: reviews need at least 10 characters.',
        ];
    }
}
