<?php
/**
 * @package    Requests
 ****************************************************
 * @date       02/29/2020 11:47 AM
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\TicketStatus;
use App\Rules\TicketStatusRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketStatusStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('create', TicketStatus::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return TicketStatusRule::rules();
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return TicketStatusRule::messages();
    }
}
