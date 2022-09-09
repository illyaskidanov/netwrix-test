<?php

namespace app\controllers;

use app\models\PartnerLocator;
use app\models\PartnerSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\rest\ActiveController;

class PartnerController extends ActiveController
{
    public $modelClass = PartnerLocator::class;

    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider']
            ]
        ];
    }

    /**
     * @throws Exception
     */
    public function prepareDataProvider(): ActiveDataProvider
    {
        $filter = new PartnerSearch();
        $filter->load(Yii::$app->request->get());

        if (! $filter->validate()) {
            throw new \yii\base\Exception(json_encode($filter->errors));
        }

        $query = PartnerLocator::find();

        if (!empty($filter->searchQuery)) {
            $query->andWhere([
                'OR',
                ['like', 'company', $filter->searchQuery],
                ['like', 'address', $filter->searchQuery]
            ]);
        }

        if (!empty($filter->status)) {
            $query->andWhere(['status' => $filter->status]);
        }

        if (!empty($filter->country)) {
            $query->andWhere(['like', 'countries_covered', $filter->country]);
        }

        if (!empty($filter->state)) {
            $query->andWhere(['like', 'states_covered', $filter->state]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
    }
}
