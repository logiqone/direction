<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'freeze', 'deleted', 'brand_id', 'weight', 'novelty', 'bestseller', 'collection_id', 'discount_id', 'sort'], 'integer'],
            [['code', 'code_kupinoj', 'name', 'availability', 'short_description', 'full_description', 'video_link', 'promo_title', 'promo_description', 'promo_keywords', 'promo_robots'], 'safe'],
            [['price'], 'number'],
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
        $query = Product::find();

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
            'freeze' => $this->freeze,
            'deleted' => $this->deleted,
            'brand_id' => $this->brand_id,
            'weight' => $this->weight,
            'price' => $this->price,
            'novelty' => $this->novelty,
            'bestseller' => $this->bestseller,
            'collection_id' => $this->collection_id,
            'discount_id' => $this->discount_id,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'code_kupinoj', $this->code_kupinoj])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'availability', $this->availability])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'full_description', $this->full_description])
            ->andFilterWhere(['like', 'video_link', $this->video_link])
            ->andFilterWhere(['like', 'promo_title', $this->promo_title])
            ->andFilterWhere(['like', 'promo_description', $this->promo_description])
            ->andFilterWhere(['like', 'promo_keywords', $this->promo_keywords])
            ->andFilterWhere(['like', 'promo_robots', $this->promo_robots]);

        return $dataProvider;
    }
}
