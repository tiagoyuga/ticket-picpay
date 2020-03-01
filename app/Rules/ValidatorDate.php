<?php


namespace App\Rules;


use App\Models\Place;
use App\Util\MDate;
use Carbon\Carbon;

trait ValidatorDate
{
    protected function validateNotPast($attibute, $value)
    {
        if (!$this->requiredField('date')) return false;

        $date = Carbon::createFromFormat('d/m/Y', $this->getValue('date'));

        return !$date->addDay()->isPast();
    }

}
