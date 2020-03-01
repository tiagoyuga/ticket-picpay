<?php
/**
 * @package    Requests
 ****************************************************
 * @date       09/12/2019 10:25:33
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\UserRule;
use Illuminate\Foundation\Http\FormRequest;

class AdministratorStoreRequest extends FormRequest
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
        $rules['type'] = 'required';
        $rules['email'] = str_replace('nullable', 'required', $rules['email']);
        $rules['password'] = str_replace('nullable', 'required', $rules['password']);
        $rules['image'] = str_replace('required', 'nullable', $rules['image']);
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
