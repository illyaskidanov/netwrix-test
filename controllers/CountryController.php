<?php

namespace app\controllers;

use app\models\LocCountry;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class CountryController extends ActiveController
{
    public $modelClass = LocCountry::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $this->modelClass::find(),
            'pagination' => false
        ]);
    }
}
