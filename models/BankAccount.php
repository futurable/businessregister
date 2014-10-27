<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_account".
 *
 * @property integer $id
 * @property string $iban
 * @property string $name
 * @property string $status
 * @property string $create_date
 * @property string $modify_date
 * @property integer $bank_user_id
 * @property integer $bank_bic_id
 * @property integer $bank_interest_id
 * @property integer $bank_currency_id
 * @property integer $bank_account_type_id
 *
 * @property BankAccountType $bankAccountType
 * @property BankBic $bankBic
 * @property BankCurrency $bankCurrency
 * @property BankInterest $bankInterest
 * @property BankUser $bankUser
 * @property BankAccountTransaction[] $bankAccountTransactions
 * @property BankLoan[] $bankLoans
 */
class BankAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_account';
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
            [['status'], 'string'],
            [['create_date', 'modify_date'], 'safe'],
            [['bank_user_id'], 'required'],
            [['bank_user_id', 'bank_bic_id', 'bank_interest_id', 'bank_currency_id', 'bank_account_type_id'], 'integer'],
            [['iban'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 64],
            [['iban'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'iban' => Yii::t('app', 'International Bank Account Number (IBAN) to identify the account'),
            'name' => Yii::t('app', 'User-given account name'),
            'status' => Yii::t('app', 'Account status  ( enabled, disabled / removed )'),
            'create_date' => Yii::t('app', 'The date the account has been created'),
            'modify_date' => Yii::t('app', 'The most recent date the account has been altered'),
            'bank_user_id' => Yii::t('app', 'Bank User ID'),
            'bank_bic_id' => Yii::t('app', 'Bank Bic ID'),
            'bank_interest_id' => Yii::t('app', 'Bank Interest ID'),
            'bank_currency_id' => Yii::t('app', 'Bank Currency ID'),
            'bank_account_type_id' => Yii::t('app', 'Bank Account Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccountType()
    {
        return $this->hasOne(BankAccountType::className(), ['id' => 'bank_account_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankBic()
    {
        return $this->hasOne(BankBic::className(), ['id' => 'bank_bic_id']);
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
    public function getBankInterest()
    {
        return $this->hasOne(BankInterest::className(), ['id' => 'bank_interest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankUser()
    {
        return $this->hasOne(BankUser::className(), ['id' => 'bank_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccountTransactions()
    {
        return $this->hasMany(BankAccountTransaction::className(), ['payer_iban' => 'iban']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankLoans()
    {
        return $this->hasMany(BankLoan::className(), ['bank_account_id' => 'id']);
    }
}
