<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_account_type".
 *
 * @property integer $id
 * @property string $type
 * @property string $description
 *
 * @property BankAccount[] $bankAccounts
 * @property BankInterest[] $bankInterests
 */
class BankAccountType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_account_type';
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
            [['type'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Account type. Ex. checking account, loan account, savings account'),
            'description' => Yii::t('app', 'Longer account description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccounts()
    {
        return $this->hasMany(BankAccount::className(), ['bank_account_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankInterests()
    {
        return $this->hasMany(BankInterest::className(), ['bank_account_type_id' => 'id']);
    }
}
