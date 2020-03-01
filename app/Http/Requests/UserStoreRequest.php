<?php
/**
 * @package    Requests
 ****************************************************
 * @date       02/25/2020 8:56 PM
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\UserRule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('create', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = UserRule::rules();
        $rules['password'] = 'required|' . $rules['password'];
        $rules['file'] = 'nullable|mimes:jpeg,png,jpg,pdf|max:4048';

        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return UserRule::messages();
    }
}
