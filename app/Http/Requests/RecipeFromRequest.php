<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class RecipeFromRequest extends Request
{
    /**
     * Check out of user is authorized to make this request.
     *
     * @return bool
     */
    public function authorized(): bool
    {
        if ($this->user()->isAdmin()) {
            return true;
        }
        return false;
    }

    /**
     * Get validation rules that apply to the query.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:recipes|max:255',
            'title' => array('Regex:/^[A-Za-z0-9 ]+$/'),
            'body' => 'required',
        ];
    }
}
