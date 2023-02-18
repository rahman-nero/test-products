<?php

namespace App\Http\Requests\User\Request;

use App\Http\Enums\ProductQuality;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|min:4',
            'min_price' => 'required|integer|min:1',
            'max_price' => 'required|integer|min:1',
            'quality' => ['required', new Enum(ProductQuality::class)],
        ];
    }
}
