<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[ViewPeople]].
 *
 * @see ViewPeople
 */
class ViewPeoplesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ViewPeople[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ViewPeople|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}