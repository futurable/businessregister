<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $activkey
 * @property integer $createtime
 * @property integer $lastvisit
 * @property integer $superuser
 * @property integer $status
 *
 * @property BankAccount[] $bankAccounts
 * @property BankLoan[] $bankLoans
 */
class BankUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_user';
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
            [['username', 'password', 'email'], 'required'],
            [['createtime', 'lastvisit', 'superuser', 'status'], 'integer'],
            [['username'], 'string', 'max' => 64],
            [['password'], 'string', 'max' => 512],
            [['email'], 'string', 'max' => 256],
            [['activkey'], 'string', 'max' => 128],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'activkey' => Yii::t('app', 'Activkey'),
            'createtime' => Yii::t('app', 'Createtime'),
            'lastvisit' => Yii::t('app', 'Lastvisit'),
            'superuser' => Yii::t('app', 'Superuser'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccounts()
    {
        return $this->hasMany(BankAccount::className(), ['bank_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankLoans()
    {
        return $this->hasMany(BankLoan::className(), ['bank_user_id' => 'id']);
    }
}
