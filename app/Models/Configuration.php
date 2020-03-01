<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configuration extends Model
{
    use SoftDeletes;

    protected $table = 'configurations';

    protected $fillable = [
        'name',
        'key',
        'value'
    ];

    public function creationData()
    {
        $info = [];

        if ($this->user_creator_id) {

            $info[] = 'Criado por ' . $this->creator->name . ' em ' . $this->created_at->format('d/m/Y H:i');
        }

        if ($this->user_updater_id) {

            $info[] = 'Atualizado por ' . $this->updater->name . ' em ' . $this->updated_at->format('d/m/Y H:i');
        }

        return $info;
    }
}
