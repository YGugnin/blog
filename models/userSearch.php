<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\user;

/**
 * userSearch represents the model behind the search form about `app\models\user`.
 */
class userSearch extends user
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active'], 'integer'],
            [['first_name', 'last_name', 'email', 'password', 'birth_date', 'avatar', 'registered_at'], 'safe'],
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
        $query = user::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if($this->birth_date){
            list($from, $to) = explode(' - ', $this->birth_date);
            if($from && $to){
                $query->andFilterWhere(['between', 'birth_date', date("Y-m-d", strtotime($from)), date("Y-m-d", strtotime($to))]);
            }
        }

        if($this->registered_at){
            list($from, $to) = explode(' - ', $this->registered_at);
            if($from && $to){
                $query->andFilterWhere(['between', 'registered_at', date("Y-m-d 00:00:00", strtotime($from)), date("Y-m-d 23:59:59", strtotime($to))]);
            }
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'active' => 1,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
