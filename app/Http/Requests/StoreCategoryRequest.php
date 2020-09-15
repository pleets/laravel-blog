<?php

namespace App\Http\Requests;

use App\Constants\Resource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can(Resource::CATEGORY_CREATE);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $category = $this->route('category');

        return [
            'name' => 'required|max:80',
            'slug' => [
                'required',
                'max:80',
                Rule::unique('categories')->ignore(optional($category)->category_id, 'category_id')
            ],
        ];
    }
}
