<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_account_transaction".
 *
 * @property integer $id
 * @property string $recipient_iban
 * @property string $recipient_bic
 * @property string $recipient_name
 * @property string $payer_iban
 * @property string $payer_bic
 * @property string $payer_name
 * @property string $event_date
 * @property string $create_date
 * @property string $modify_date
 * @property string $amount
 * @property string $reference_number
 * @property string $message
 * @property string $exchange_rate
 * @property string $currency
 * @property string $status
 *
 * @property BankAccount $payerIban
 */
class BankAccountTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_account_transaction';
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
            [['recipient_bic', 'payer_iban', 'payer_bic', 'payer_name'], 'required'],
            [['event_date', 'create_date', 'modify_date'], 'safe'],
            [['amount', 'exchange_rate'], 'number'],
            [['status'], 'string'],
            [['recipient_iban', 'payer_iban'], 'string', 'max' => 32],
            [['recipient_bic', 'payer_bic'], 'string', 'max' => 11],
            [['recipient_name', 'payer_name'], 'string', 'max' => 35],
            [['reference_number'], 'string', 'max' => 20],
            [['message'], 'string', 'max' => 420],
            [['currency'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Unique ID for transactions
'),
            'recipient_iban' => Yii::t('app', 'IBAN-number of the recipient (creditor)'),
            'recipient_bic' => Yii::t('app', 'Recipient Bic'),
            'recipient_name' => Yii::t('app', 'Name of the recipient (creditor)'),
            'payer_iban' => Yii::t('app', 'Payer Iban'),
            'payer_bic' => Yii::t('app', 'Payer Bic'),
            'payer_name' => Yii::t('app', 'Payer Name'),
            'event_date' => Yii::t('app', 'The event date of the transaction (when the transaction is done)'),
            'create_date' => Yii::t('app', 'The creation date of the transaction'),
            'modify_date' => Yii::t('app', 'The most recent alteration date of the transaction'),
            'amount' => Yii::t('app', 'The sum of the transaction'),
            'reference_number' => Yii::t('app', 'Reference number for the recipient'),
            'message' => Yii::t('app', 'Message for recipient'),
            'exchange_rate' => Yii::t('app', 'Currency rate of the transaction. Default currency is EUR'),
            'currency' => Yii::t('app', 'Currency of the transaction. Default currency EUR has currencyRate of 1.00'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayerIban()
    {
        return $this->hasOne(BankAccount::className(), ['iban' => 'payer_iban']);
    }
}
