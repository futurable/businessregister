<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank_profile_field".
 *
 * @property integer $id
 * @property string $varname
 * @property string $title
 * @property string $field_type
 * @property integer $field_size
 * @property integer $field_size_min
 * @property integer $required
 * @property string $match
 * @property string $range
 * @property string $error_message
 * @property string $other_validator
 * @property string $default
 * @property string $widget
 * @property string $widgetparams
 * @property integer $position
 * @property integer $visible
 */
class BankProfileField extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_profile_field';
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
            [['varname', 'title', 'field_type'], 'required'],
            [['field_size', 'field_size_min', 'required', 'position', 'visible'], 'integer'],
            [['varname', 'field_type'], 'string', 'max' => 50],
            [['title', 'match', 'range', 'error_message', 'default', 'widget'], 'string', 'max' => 255],
            [['other_validator', 'widgetparams'], 'string', 'max' => 5000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'varname' => Yii::t('app', 'Varname'),
            'title' => Yii::t('app', 'Title'),
            'field_type' => Yii::t('app', 'Field Type'),
            'field_size' => Yii::t('app', 'Field Size'),
            'field_size_min' => Yii::t('app', 'Field Size Min'),
            'required' => Yii::t('app', 'Required'),
            'match' => Yii::t('app', 'Match'),
            'range' => Yii::t('app', 'Range'),
            'error_message' => Yii::t('app', 'Error Message'),
            'other_validator' => Yii::t('app', 'Other Validator'),
            'default' => Yii::t('app', 'Default'),
            'widget' => Yii::t('app', 'Widget'),
            'widgetparams' => Yii::t('app', 'Widgetparams'),
            'position' => Yii::t('app', 'Position'),
            'visible' => Yii::t('app', 'Visible'),
        ];
    }
}
