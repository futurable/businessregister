<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "costbenefit_item_view".
 *
 * @property integer $company_id
 * @property integer $costbenefit_calculation_id
 * @property string $value
 * @property string $name
 * @property string $description
 * @property integer $account
 */
class CostbenefitItemView extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'costbenefit_item_view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'costbenefit_calculation_id', 'value', 'name'], 'required'],
            [['company_id', 'costbenefit_calculation_id', 'account'], 'integer'],
            [['value'], 'number'],
            [['name'], 'string', 'max' => 256],
            [['description'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => Yii::t('app', 'Company ID'),
            'costbenefit_calculation_id' => Yii::t('app', 'Costbenefit Calculation ID'),
            'value' => Yii::t('app', 'Value'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'account' => Yii::t('app', 'Account'),
        ];
    }
}
