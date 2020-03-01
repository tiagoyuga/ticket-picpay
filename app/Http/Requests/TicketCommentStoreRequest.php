<?php
/**
 * @package    Requests
 ****************************************************
 * @date       02/29/2020 11:49 AM
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\TicketComment;
use App\Rules\TicketCommentRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketCommentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->user()->can('create', TicketComment::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return TicketCommentRule::rules();
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {

        return TicketCommentRule::messages();
    }
}
