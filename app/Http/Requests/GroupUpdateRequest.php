<?php
/**
 * @package    Requests
 ****************************************************
 * @date       02/25/2020 9:07 PM
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\GroupRule;
use Illuminate\Foundation\Http\FormRequest;

class GroupUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('update', $this->group);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return GroupRule::rules();
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return GroupRule::messages();
    }
}
