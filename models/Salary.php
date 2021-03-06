<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salary".
 *
 * @property integer $id
 * @property string $create_date
 * @property integer $employees
 * @property string $amount
 * @property integer $week
 * @property integer $bank_transaction_id
 * @property integer $company_id
 * @property string $year
 *
 * @property Company $company
 */
class Salary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date', 'year'], 'safe'],
            [['employees', 'week', 'bank_transaction_id', 'company_id'], 'integer'],
            [['amount'], 'number'],
            [['company_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'create_date' => Yii::t('app', 'Create Date'),
            'employees' => Yii::t('app', 'Employees'),
            'amount' => Yii::t('app', 'Amount'),
            'week' => Yii::t('app', 'Week'),
            'bank_transaction_id' => Yii::t('app', 'Bank Transaction ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'year' => Yii::t('app', 'Year'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
