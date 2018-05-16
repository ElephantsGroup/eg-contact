<?php

namespace elephantsGroup\contact\models;

use Yii;

/**
 * This is the model class for table "{{%eg_contact_us}}".
 *
 * @property integer $id
 * @property string $ip
 * @property integer $user_id
 * @property string $email
 * @property string $subject
 * @property string $description
 * @property integer $sort_order
 * @property integer $status
 * @property string $update_time
 * @property string $creation_time
 */
class ContactUs extends \yii\db\ActiveRecord
{
    public static $_STATUS_DISABLED = 0;
    public static $_STATUS_ENABLED = 1;

    public static function getStatus()
    {
        return [
            self::$_STATUS_DISABLED => Yii::t('app', 'Disabled'),
            self::$_STATUS_ENABLED => Yii::t('app', 'Enabled')
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eg_contact_us}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip', 'email', 'subject', 'description'], 'trim'],
            [['user_id', 'sort_order', 'status'], 'integer'],
            [['email'], 'required'],
            [['email'], 'email'],
            [['description'], 'string'],
            [['update_time', 'creation_time'], 'date'],
            [['ip'], 'string', 'max' => 32],
            [['email', 'subject'], 'string', 'max' => 128],
            [['sort_order'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => self::$_STATUS_DISABLED],
            [['update_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
            [['creation_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
            [['status'], 'in', 'range' => array_keys(self::getStatus())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ip' => Yii::t('app', 'Ip'),
            'user_id' => Yii::t('app', 'User ID'),
            'email' => Yii::t('app', 'Email'),
            'subject' => Yii::t('app', 'Subject'),
            'description' => Yii::t('app', 'Description'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
            'update_time' => Yii::t('app', 'Update Time'),
            'creation_time' => Yii::t('app', 'Creation Time'),
        ];
    }

    public function beforeSave($insert)
    {
        $date = new \DateTime();
        $date->setTimestamp(time());
        $date->setTimezone(new \DateTimezone('Iran'));
        $this->update_time = $date->format('Y-m-d H:i:s');
        if($this->isNewRecord)
            $this->creation_time = $date->format('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }





    /**
     * @inheritdoc
     * @return \common\models\ContactUsQuery the active query used by this AR class.
     */
    /*public static function find()
    {
        return new \common\models\ContactUsQuery(get_called_class());
    }*/
}
