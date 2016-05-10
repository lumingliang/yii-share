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
            [['nick_name', 'created_at', 'updated_at', 'open_id', 'share_cookie', 'weixin_nick_name'], 'safe'],
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
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'view_times' => $this->view_times,
        ]);

        $query->andFilterWhere(['like', 'nick_name', $this->nick_name])
            ->andFilterWhere(['like', 'open_id', $this->open_id])
            ->andFilterWhere(['like', 'share_cookie', $this->share_cookie])
            ->andFilterWhere(['like', 'weixin_nick_name', $this->weixin_nick_name]);

        return $dataProvider;
    }
}
