<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_loan".
 *
 * @property integer $id
 * @property string $type
 * @property string $amount
 * @property integer $term
 * @property string $term_interval
 * @property string $instalment
 * @property string $repayment
 * @property string $interval
 * @property string $interest
 * @property string $interest_updated
 * @property integer $event_day
 * @property string $create_date
 * @property string $grant_date
 * @property string $accept_date
 * @property string $modify_date
 * @property string $status
 * @property integer $bank_interest_id
 * @property integer $bank_account_id
 * @property integer $bank_currency_id
 * @property integer $bank_user_id
 *
 * @property BankAccount $bankAccount
 * @property BankCurrency $bankCurrency
 * @property BankUser $bankUser
 */
class BankLoan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_loan';
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
            [['type', 'term_interval', 'interval', 'status'], 'string'],
            [['amount', 'instalment', 'repayment', 'interest'], 'number'],
            [['term', 'event_day', 'bank_interest_id', 'bank_account_id', 'bank_currency_id', 'bank_user_id'], 'integer'],
            [['term_interval', 'interest', 'bank_interest_id', 'bank_account_id', 'bank_user_id'], 'required'],
            [['interest_updated', 'create_date', 'grant_date', 'accept_date', 'modify_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Loan unique identification'),
            'type' => Yii::t('app', 'Loan repayment type (fixed repayment, fixed instalment, annuity)'),
            'amount' => Yii::t('app', 'Amount of loan'),
            'term' => Yii::t('app', 'Loan length in termInterval units (day, week, month,year). Applies to annyity loans'),
            'term_interval' => Yii::t('app', 'Term interval'),
            'instalment' => Yii::t('app', 'The part of repayment that will diminish the principal (doesn\'t include interest)'),
            'repayment' => Yii::t('app', 'The whole repayment ( instalment + interest )'),
            'interval' => Yii::t('app', 'Repayment interval (day,week,month,year)'),
            'interest' => Yii::t('app', 'Loan interest'),
            'interest_updated' => Yii::t('app', 'When the interest is updated'),
            'event_day' => Yii::t('app', 'The day of the month when automatic repayment is made'),
            'create_date' => Yii::t('app', 'Time when the loan application is made'),
            'grant_date' => Yii::t('app', 'Time when the loan application is granted'),
            'accept_date' => Yii::t('app', 'The date when loan is accepted (or declined)'),
            'modify_date' => Yii::t('app', 'The last time the loan information was altered'),
            'status' => Yii::t('app', 'Loan status'),
            'bank_interest_id' => Yii::t('app', 'Loan interest and loan margin'),
            'bank_account_id' => Yii::t('app', 'Bank Account ID'),
            'bank_currency_id' => Yii::t('app', 'Bank Currency ID'),
            'bank_user_id' => Yii::t('app', 'Bank User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccount()
    {
        return $this->hasOne(BankAccount::className(), ['id' => 'bank_account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankCurrency()
    {
        return $this->hasOne(BankCurrency::className(), ['id' => 'bank_currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankUser()
    {
        return $this->hasOne(BankUser::className(), ['id' => 'bank_user_id']);
    }
}
