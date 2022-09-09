<?php

declare(strict_types=1);

namespace app\models;

use yii\base\Model;

class PartnerSearch extends Model
{
    public $searchQuery;
    public $status;
    public $country;
    public $state;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            ['searchQuery', 'string', 'max' => 255],
            ['status', 'string'],
            ['country', 'string', 'max' => 2],
            ['state', 'string', 'max' => 2],
        ];
    }
}