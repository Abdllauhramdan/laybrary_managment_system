<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // يمكنك ضبطها وفقًا للتحقق من الصلاحيات
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|string',
            'reviewable_id' => 'required|integer',
            'reviewable_type' => 'required|string',
            // قد تحتاج لقواعد إضافية بناءً على متطلباتك
        ];
    }
}
