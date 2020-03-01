<?php
/**
 * @package    Rules
 ****************************************************
 * @date       02/29/2020 11:49 AM
 */

declare(strict_types=1);

namespace App\Rules;

class TicketCommentRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
	protected static $rules = [
		'id' => 'required',
        'user_id' => 'required',
        'ticket_id' => 'required',
        'content' => 'required',
	];

    /**
     * Return default rules
     *
     * @return array
     */
    public static function rules()
    {

        return [
            //'user_id' => self::$rules['user_id'],
            'ticket_id' => self::$rules['ticket_id'],
            'content' => self::$rules['content'],
        ];
    }

    /**
     * Return default messages
     *
     * @return array
     */
    public static function messages()
    {

        return [];
    }
}
