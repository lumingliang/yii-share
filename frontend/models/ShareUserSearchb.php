<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ShareUser;

/**
 * ShareUserSearch represents the model behind the search form about `frontend\models\ShareUser`.
 */
class ShareUserSearch extends ShareUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'view_times'], 'integer'],
            [['nick_name', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ShareUser::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'key' => function($model) {
                // return md5($model->id);
            // },
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // $query是一个引用
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'viewTimes' => $this->viewTimes,
        ]);

        $query->andFilterWhere(['like', 'nickName', $this->nickName]);

        return $dataProvider;
    }
}
