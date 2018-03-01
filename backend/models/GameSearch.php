<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Game;

/**
 * GameSearch represents the model behind the search form of `common\models\Game`.
 */
class GameSearch extends Game
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'platform', 'onsale', 'sale_start_time', 'sale_end_time', 'have_dlc', 'have_demo', 'release_time'], 'integer'],
            [['name', 'developer', 'publisher', 'picture', 'content', 'language'], 'safe'],
            [['price', 'score', 'sale_price', 'region'], 'number'],
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
        $query = Game::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'score' => $this->score,
            'platform' => $this->platform,
            'onsale' => $this->onsale,
            'sale_price' => $this->sale_price,
            'sale_start_time' => $this->sale_start_time,
            'sale_end_time' => $this->sale_end_time,
            'have_dlc' => $this->have_dlc,
            'have_demo' => $this->have_demo,
            'release_time' => $this->release_time,
            'region' => $this->region,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'developer', $this->developer])
            ->andFilterWhere(['like', 'publisher', $this->publisher])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'language', $this->language]);

        return $dataProvider;
    }
}
