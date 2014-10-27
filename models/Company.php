<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $tag
 * @property string $business_id
 * @property string $email
 * @property integer $employees
 * @property integer $active
 * @property string $create_time
 * @property string $bank_account_created
 * @property string $openerp_database_created
 * @property string $backend_user_created
 * @property string $account_mail_sent
 * @property integer $token_key_id
 * @property integer $industry_id
 * @property integer $token_customer_id
 *
 * @property TokenKey $tokenKey
 * @property Industry $industry
 * @property TokenCustomer $tokenCustomer
 * @property CompanyPasswords[] $companyPasswords
 * @property Contact[] $contacts
 * @property CostbenefitCalculation[] $costbenefitCalculations
 * @property Order[] $orders
 * @property Remark[] $remarks
 * @property Salary[] $salaries
 * @property User[] $users
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * A helper property for search
     */
    public $searchTerm;
    public $bank_account;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tag', 'business_id', 'email', 'employees', 'token_key_id', 'industry_id', 'token_customer_id'], 'required'],
            [['employees', 'active', 'token_key_id', 'industry_id', 'token_customer_id'], 'integer'],
            [['create_time', 'bank_account_created', 'openerp_database_created', 'backend_user_created', 'account_mail_sent'], 'safe'],
            [['name', 'email'], 'string', 'max' => 256],
            [['tag'], 'string', 'max' => 64],
            [['business_id'], 'string', 'max' => 9],
            [['tag'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'tag' => Yii::t('app', 'Tag'),
            'business_id' => Yii::t('app', 'Business ID'),
            'email' => Yii::t('app', 'Email'),
            'employees' => Yii::t('app', 'Employees'),
            'active' => Yii::t('app', 'Active'),
            'create_time' => Yii::t('app', 'Create Time'),
            'bank_account_created' => Yii::t('app', 'Bank Account Created'),
            'openerp_database_created' => Yii::t('app', 'Openerp Database Created'),
            'backend_user_created' => Yii::t('app', 'Backend User Created'),
            'account_mail_sent' => Yii::t('app', 'Account Mail Sent'),
            'token_key_id' => Yii::t('app', 'Token Key ID'),
            'industry_id' => Yii::t('app', 'Industry ID'),
            'token_customer_id' => Yii::t('app', 'Token Customer ID'),
            'searchTerm' => Yii::t('app', 'Search term'),
            'bank_account' => Yii::t('app', 'Bank account'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokenKey()
    {
        return $this->hasOne(TokenKey::className(), ['id' => 'token_key_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustry()
    {
        return $this->hasOne(Industry::className(), ['id' => 'industry_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokenCustomer()
    {
        return $this->hasOne(TokenCustomer::className(), ['id' => 'token_customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyPasswords()
    {
        return $this->hasMany(CompanyPasswords::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCostbenefitCalculations()
    {
        return $this->hasMany(CostbenefitCalculation::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemarks()
    {
        return $this->hasMany(Remark::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaries()
    {
        return $this->hasMany(Salary::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['company_id' => 'id']);
    }
}
