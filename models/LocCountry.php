<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "loc_country".
 *
 * @property int $country_id
 * @property string $name
 * @property string|null $short_name
 * @property LocState[] $states
 */
class LocCountry extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loc_country';
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'states';
        return $fields;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['short_name'], 'string', 'max' => 50],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'Country ID',
            'name' => 'Name',
            'short_name' => 'Short Name',
        ];
    }

    public function getStates()
    {
        return $this->hasMany(LocState::class, ['country_id' => 'country_id']);
    }
}
