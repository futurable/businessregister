<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_interest".
 *
 * @property integer $id
 * @property string $rate
 * @property string $name
 * @property string $create_date
 * @property string $modify_date
 * @property integer $bank_account_type_id
 *
 * @property BankAccount[] $bankAccounts
 * @property BankAccountType $bankAccountType
 */
class BankInterest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_interest';
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
            [['rate'], 'number'],
            [['create_date', 'modify_date'], 'safe'],
            [['bank_account_type_id'], 'required'],
            [['bank_account_type_id'], 'integer'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Unique interest ID'),
            'rate' => Yii::t('app', 'Interest rate'),
            'name' => Yii::t('app', 'Short description'),
            'create_date' => Yii::t('app', 'Interest adding date'),
            'modify_date' => Yii::t('app', 'When interest was last updated'),
            'bank_account_type_id' => Yii::t('app', 'Bank Account Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccounts()
    {
        return $this->hasMany(BankAccount::className(), ['bank_interest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccountType()
    {
        return $this->hasOne(BankAccountType::className(), ['id' => 'bank_account_type_id']);
    }
}
