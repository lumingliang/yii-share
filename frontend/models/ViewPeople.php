<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "view_peoples".
 *
 * @property integer $id
 * @property string $mobileMime
 * @property integer $shareuserId
 * @property string $created_at
 * @property string $updated_at
 */
class ViewPeople extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_peoples';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['open_id', 'share_user_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'open_id' => '用户微信openId',
            'share_user_id' => '分享者id',
            'created_at' => '第一次浏览时间',
            'updated_at' => '最后一次浏览时间',
        ];
    }

    /**
     * @inheritdoc
     * @return ViewPeoplesQuery the active query used by this AR class.
     */
    // public static function find()
    // {
        // return new ViewPeoplesQuery(get_called_class());
    // }

    public static function hasMobileMime($shareToken, $id) {
        $result = static::findOne(['mobileMime' => $shareToken]);
        // var_dump($result);
        // if($result) {
            // echo 1;
        // } else {
            // echo 0;
        // }
        //echo ( string )$result;
        // exit;
        if($result) {
            return true;
        }else {
            return false;
        } 
    }
}
