<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ViewPeople;

/**
 * ViewPeopleSearch represents the model behind the search form about `frontend\models\ViewPeople`.
 */
class ViewPeopleSearch extends ViewPeople
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'share_user_id'], 'integer'],
            [['created_at', 'updated_at', 'open_id'], 'safe'],
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
        $query = ViewPeople::find();

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
            'share_user_id' => $this->share_user_id,
        ]);

        $query->andFilterWhere(['like', 'open_id', $this->open_id]);

        return $dataProvider;
    }
}
