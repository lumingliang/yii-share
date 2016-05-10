<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[testIoGii]].
 *
 * @see testIoGii
 */
class testIoGiiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return testIoGii[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return testIoGii|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}