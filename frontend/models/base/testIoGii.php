<?php

namespace frontend\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "test_io_gii".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 */
class testIoGii extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 20],
            // [['lock'], 'default', 'value' => '0'],
            // [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_io_gii';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => '邮箱',
        ];
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    // public function behaviors()
    // {
        // return [
            // [
                // 'class' => TimestampBehavior::className(),
                // 'createdAtAttribute' => 'created_at',
                // 'updatedAtAttribute' => 'updated_at',
            // ],
            // [
                // 'class' => BlameableBehavior::className(),
                // 'createdByAttribute' => 'created_by',
                // 'updatedByAttribute' => 'updated_by',
            // ],
            // [
                // 'class' => UUIDBehavior::className(),
                // 'column' => 'id',
            // ],
        // ];
    // }

    /**
     * @inheritdoc
     * @return \frontend\models\testIoGiiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\testIoGiiQuery(get_called_class());
    }
}
