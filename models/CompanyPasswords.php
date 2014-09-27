<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_passwords".
 *
 * @property integer $id
 * @property string $bank_password
 * @property string $openerp_password
 * @property string $backend_password
 * @property integer $company_id
 *
 * @property Company $company
 */
class CompanyPasswords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_passwords';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'required'],
            [['company_id'], 'integer'],
            [['bank_password', 'openerp_password', 'backend_password'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bank_password' => Yii::t('app', 'Bank Password'),
            'openerp_password' => Yii::t('app', 'Openerp Password'),
            'backend_password' => Yii::t('app', 'Backend Password'),
            'company_id' => Yii::t('app', 'Company ID'),
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
