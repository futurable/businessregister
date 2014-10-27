<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_currency".
 *
 * @property integer $id
 * @property string $code
 * @property string $exchange_rate
 *
 * @property BankAccount[] $bankAccounts
 * @property BankLoan[] $bankLoans
 */
class BankCurrency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_currency';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_bank');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exchange_rate'], 'number'],
            [['code'], 'string', 'max' => 3],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Currency code (ex. EUR or USD)'),
            'exchange_rate' => Yii::t('app', 'Exchange rate. EUR has 1.00'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccounts()
    {
        return $this->hasMany(BankAccount::className(), ['bank_currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankLoans()
    {
        return $this->hasMany(BankLoan::className(), ['bank_currency_id' => 'id']);
    }
}
