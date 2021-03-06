<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_factor".
 *
 * @property integer $id
 * @property string $value
 * @property string $name
 * @property string $description
 * @property string $create_date
 * @property string $alter_date
 * @property integer $order_setup_id
 *
 * @property OrderSetup $orderSetup
 */
class OrderFactor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_factor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_setup_id'], 'required'],
            [['id', 'order_setup_id'], 'integer'],
            [['value'], 'number'],
            [['create_date', 'alter_date'], 'safe'],
            [['name'], 'string', 'max' => 32],
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
            'value' => Yii::t('app', 'Value'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'create_date' => Yii::t('app', 'Create Date'),
            'alter_date' => Yii::t('app', 'Alter Date'),
            'order_setup_id' => Yii::t('app', 'Order Setup ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderSetup()
    {
        return $this->hasOne(OrderSetup::className(), ['id' => 'order_setup_id']);
    }
}
