<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>'required|string|min:4|max:255',
            'description'=>'nullable|string',
            'date'=>'nullable|date|after_or_equal:now',
            'completed'=>'required|boolean'
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'The title of the task is required!',
            'title.max'=>'The title can have maximum of 255 characters',
            'date.date'=>'The date must be in the Y-m-d format (es 2023-10-02)',
            'date.after_or_equal'=>'The date must be today or a future date',
            'completed.required'=>'Indicate if task is complete or not',
            
        ];
        
    }
}
