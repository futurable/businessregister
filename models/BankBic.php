<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_bic".
 *
 * @property integer $id
 * @property integer $branch_code
 * @property string $bic
 * @property string $bank_name
 * @property string $create_date
 *
 * @property BankAccount[] $bankAccounts
 */
class BankBic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_bic';
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
            [['branch_code', 'bic', 'bank_name'], 'required'],
            [['branch_code'], 'integer'],
            [['create_date'], 'safe'],
            [['bic'], 'string', 'max' => 11],
            [['bank_name'], 'string', 'max' => 256],
            [['branch_code'], 'unique'],
            [['bic'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'branch_code' => Yii::t('app', 'Bank branch code'),
            'bic' => Yii::t('app', 'Bank BIC identifier'),
            'bank_name' => Yii::t('app', 'Bank name'),
            'create_date' => Yii::t('app', 'Line creation date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccounts()
    {
        return $this->hasMany(BankAccount::className(), ['bank_bic_id' => 'id']);
    }
}
