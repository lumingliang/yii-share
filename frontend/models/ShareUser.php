<?php

namespace frontend\models;

use Yii;
use frontend\models\ViewPeople;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "share_users".
 *
 * @property integer $id
 * @property string $nickName
 * @property string $created_at
 * @property string $updated_at
 * @property integer $viewTimes
 */
class ShareUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'share_users';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['nickName', 'viewTimes'], 'required'],
            ['nick_name', 'required', 'message' => '班级或呢称不能为空'],
            ['nick_name', 'string', 'min' => 2, 'tooShort' => '班级或呢称至少填写两个字符'],
            ['nick_name', 'unique', 'message' => '该班级或呢称已经被使用'],
            [['created_at', 'updated_at'], 'safe'],
            [['view_times'], 'integer'],
           // [['nickName'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nick_name' => '呢称',
            'created_at' => '分享创建时间',
            'view_times' => '分享被浏览次数',
            'weixin_nick_name' => '微信呢称',
        ];
    }

    /**
     * @inheritdoc
     * @return ShareUsersQuery the active query used by this AR class.
     */
    // public static function find()
    // {
        // return new ShareUsersQuery(get_called_class());
    // }

    public function getViewPeoples() {

        // 一个分享者可以有多个浏览者，关联浏览者的model类，并且声明浏览者的外(关联对象的类的属性)键和自身的对应主键(也就是类的属性)
        return $this->hasMany(ViewPeople::ClassName(), ['shareuserId' => 'id'] );
    }
}
