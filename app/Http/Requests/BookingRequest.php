<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'address' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required|string',
            'status' => 'required|string',
            // 'paymment_method' => 'required|string',
            // 'payment_status' => 'required|string',
            // 'paymnet_url' => 'required|string',
            'total_price' => 'required|numeric',
            // 'user_id' => 'required|exists:users,id',
            // 'item_id' => 'required|exists:items,id',
        ];
    }
}
