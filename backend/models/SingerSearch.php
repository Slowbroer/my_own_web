<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Singer;

/**
 * SingerSearch represents the model behind the search form of `common\models\Singer`.
 */
class SingerSearch extends Singer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'content', 'sex', 'birthday'], 'integer'],
            [['singer_name', 'brief'], 'safe'],
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
        $query = Singer::find();

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
            'content' => $this->content,
            'sex' => $this->sex,
            'birthday' => $this->birthday,
        ]);

        $query->andFilterWhere(['like', 'singer_name', $this->singer_name])
            ->andFilterWhere(['like', 'brief', $this->brief]);

        return $dataProvider;
    }
}
