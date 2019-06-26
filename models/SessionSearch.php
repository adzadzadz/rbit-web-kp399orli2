<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClassCarLocation;

/**
 * SessionSearch represents the model behind the search form of `\app\models\ClassCarLocation`.
 */
class SessionSearch extends ClassCarLocation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trainer_id', 'student_id', 'class_id', 'car_id', 'locations_id', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = ClassCarLocation::find();

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
            'trainer_id' => $this->trainer_id,
            'student_id' => $this->student_id,
            'class_id' => $this->class_id,
            'car_id' => $this->car_id,
            'locations_id' => $this->locations_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
