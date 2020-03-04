<?php
/**
 * @package    Rules
 ****************************************************
 * @date       02/25/2020 8:56 PM
 */

declare(strict_types=1);

namespace App\Rules;

class UserRule
{

    /**
     * Validation rules that apply to the request.
     *
     * @var array
     */
	protected static $rules = [
		'id' => 'required',
        'group_id' => 'required|integer|exists:groups,id,deleted_at,NULL',
        'client_id' => 'nullable|integer|exists:clients,id,deleted_at,NULL',
        'project_manager_id' => 'nullable|integer|exists:users,id,deleted_at,NULL',
        'name' => 'required|min:2|max:255',
        'email' => 'required|email|unique:users,email',
        'email_verified_at' => 'nullable|date_format:m/d/Y g:i A',
        'password' => 'string|min:6|confirmed',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        'imageUpdate' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        'file' => 'nullable|min:2|max:255',
        'document_number' => 'nullable|min:2|max:18',
        'gender' => 'nullable|in:MALE,FEMALE',
        'birth' => 'nullable|date_format:m/d/Y',
        'phone1' => 'nullable|min:2|max:15',
        'phone2' => 'nullable|min:2|max:15',
        'credit' => 'nullable',
        'is_dev' => 'nullable',
        'access' => 'nullable|integer',
        'last_login' => 'nullable|date_format:m/d/Y g:i A',
        'state' => 'nullable|min:2|max:255',
        'city' => 'nullable|min:2|max:255',
        'postal_code' => 'nullable|min:2|max:50',
        'address' => 'nullable|min:2|max:255',
        'number' => 'nullable|min:2|max:50',
        'complement' => 'nullable|min:2|max:255',
        'neighborhood' => 'nullable|min:2|max:255',
        'hour_price' => 'nullable',
        'foreign_analysis_price' => 'nullable',
        'paid_hours' => 'nullable',
        'analysis_price' => 'nullable',
        'skype' => 'nullable|min:2|max:255',
        'whatsapp' => 'nullable|min:2|max:255',
        'hangout' => 'nullable|min:2|max:255',
        'foreign_currency' => 'nullable|min:2|max:255',
        'foreign_hour_price' => 'nullable',
        'usd_unpaid_amount' => 'nullable',
        'brl_unpaid_amount' => 'nullable',
        'project_manager_price' => 'nullable',
        'foreign_project_manager_price' => 'nullable',
        'qa_price' => 'nullable',
        'foreign_qa_price' => 'nullable',
        'commission_percent' => 'nullable',
        'by_hour' => 'nullable',
        'by_hour_price' => 'nullable',
        'foreign_by_hour_price' => 'nullable',
        'weekly_working_hours' => 'nullable',
        'blocked_comment' => 'nullable',
        'user_creator_id' => 'nullable',
        'user_updater_id' => 'nullable',
        'user_eraser_id' => 'nullable',
        'remember_token' => 'nullable|min:2|max:100',
	];

    /**
     * Return default rules
     *
     * @return array
     */
    public static function rules()
    {

        return [

            'group_id' => self::$rules['group_id'],
            'client_id' => self::$rules['client_id'],
            'project_manager_id' => self::$rules['project_manager_id'],
            'name' => self::$rules['name'],
            'email' => self::$rules['email'],
            'password' => self::$rules['password'],
            'phone1' => self::$rules['phone1'],

            'state' => self::$rules['state'],
            'city' => self::$rules['city'],

            'hour_price' => self::$rules['hour_price'],
            'foreign_analysis_price' => self::$rules['foreign_analysis_price'],
            'analysis_price' => self::$rules['analysis_price'],
            'foreign_currency' => self::$rules['foreign_currency'],
            'foreign_hour_price' => self::$rules['foreign_hour_price'],
            'usd_unpaid_amount' => self::$rules['usd_unpaid_amount'],
            'brl_unpaid_amount' => self::$rules['brl_unpaid_amount'],
            'project_manager_price' => self::$rules['project_manager_price'],
            'foreign_project_manager_price' => self::$rules['foreign_project_manager_price'],
            'qa_price' => self::$rules['qa_price'],
            'foreign_qa_price' => self::$rules['foreign_qa_price'],
            'commission_percent' => self::$rules['commission_percent'],
            'by_hour' => self::$rules['by_hour'],
            'by_hour_price' => self::$rules['by_hour_price'],
            'foreign_by_hour_price' => self::$rules['foreign_by_hour_price'],
            'weekly_working_hours' => self::$rules['weekly_working_hours'],

            'skype' => self::$rules['skype'],
            'whatsapp' => self::$rules['whatsapp'],
            'hangout' => self::$rules['hangout'],


        ];
    }

    public static function profileRules()
    {

        return [

            'name' => self::$rules['name'],
            'email' => self::$rules['email'],
            'password' => self::$rules['password'],
            'phone1' => self::$rules['phone1'],
            'state' => self::$rules['state'],
            'city' => self::$rules['city'],
            'skype' => self::$rules['skype'],
            'whatsapp' => self::$rules['whatsapp'],
            'hangout' => self::$rules['hangout'],

        ];
    }


    public static function publicRegistration()
    {

        return [
            'name' => self::$rules['name'],
            'client_id' => str_replace('nullable', 'required', self::$rules['client_id']),
            'job_title' => 'required',
            'branch_location' => '',#$rules['branch_location'],
            'phone1' => self::$rules['phone1'],
            'phone2' => self::$rules['phone2'],
            'email' => self::$rules['email'],
            'password' => 'nullable|'.self::$rules['password'],
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
