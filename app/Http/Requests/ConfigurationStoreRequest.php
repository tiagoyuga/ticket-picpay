<?php
/**
 * @package    Requests
 ****************************************************
 * @date       04/11/2019 10:01:35
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Configuration;
use App\Rules\ConfigurationRule;
use App\Rules\CovenantRule;
use Illuminate\Foundation\Http\FormRequest;

class ConfigurationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('create', Configuration::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return ConfigurationRule::rules();
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return ConfigurationRule::messages();
    }
}
