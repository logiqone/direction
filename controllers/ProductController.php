<?php

namespace app\controllers;

use app\models\Category;
use app\models\ClassKnife;
use app\models\ClassType;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends AdminController
{
    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $product = new Product();
        $classKnife = new ClassKnife();
        $classType = new ClassType();

        $productsSearchModel = new ProductSearch();
        $productsDataProvider = $productsSearchModel->search(Yii::$app->request->queryParams);

        $lastProductsDataProvider = new ActiveDataProvider([
            'query' => Product::find()->limit(6),
            'pagination' => false,
            'sort'=> ['defaultOrder' => ['date_modify'=>SORT_DESC]]
        ]);

        if ($product->load(Yii::$app->request->post())) {
            $result = $product->save(false);
            if ($result) {
                Yii::$app->session->setFlash('success', 'Успешное запись. Товар успешно сохранён.');
            } else {
                Yii::$app->session->setFlash('error', 'Возникли ошибки при записе. Товар не сохранён.');
            }
        }

        return $this->render('index', [
            'productsSearchModel' => $productsSearchModel,
            'productsDataProvider' => $productsDataProvider,
            'lastProductsDataProvider' => $lastProductsDataProvider,
            'product' => $product,
            'classKnife' => $classKnife,
            'classType' => $classType,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $product = new Product();
        $classKnife = new ClassKnife();
        $classType = new ClassType();
        $isAjax = Yii::$app->request->isAjax;

        // If was a post form
        if ( $product->load(Yii::$app->request->post()) && $classKnife->load(Yii::$app->request->post()) &&
                $classType->load(Yii::$app->request->post()) ) {

            // Categories
            $categories = Yii::$app->request->post('Product')['categories'];
            if (!is_array($categories)) $product->freeze = 1;

            $result = $product->save();
            if ($result) {
                $productImage = new \app\helpers\ProductImage($product);
                $productImage->Save();

                $classKnife->product_id = $product->id;
                $classKnife->save();

                $classType->product_id = $product->id;
                $classType->save();

                foreach ($categories as $categoryId) {
                    $category = Category::findOne($categoryId);
                    $product->link('categories', $category);
                }

                if (!$isAjax) Yii::$app->session->setFlash('success', 'Успешное запись. Товар успешно сохранён.');

            } else {
                if (!$isAjax) Yii::$app->session->setFlash('error', 'Возникли ошибки при записи. Товар не сохранён.');
            }
        }

        if ($isAjax) {
            return $this->renderAjax('_form', [
                'product' => $product,
                'classKnife' => $classKnife,
                'classType' => $classType,
            ]);
        } else {
            return $this->render('create', [
                'product' => $product,
                'classKnife' => $classKnife,
                'classType' => $classType,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $isAjax = Yii::$app->request->isAjax;

        $product = $this->findModel($id);

        if (ClassKnife::find()->where(['product_id' => $id])->exists()) {
            $classKnife = ClassKnife::findOne(['product_id' => $id]);
        }
        else {
            $classKnife = new ClassKnife();
            $classKnife->product_id = $id;
        }

        if (ClassType::find()->where(['product_id' => $id])->exists()) {
            $classType = ClassType::findOne(['product_id' => $id]);
        }
        else {
            $classType = new ClassType();
            $classType->product_id = $id;
        }

        // If post form
        if ( $product->load(Yii::$app->request->post()) &&
             $classKnife->load(Yii::$app->request->post()) &&
             $classType->load(Yii::$app->request->post()) ) {

            $categories = Yii::$app->request->post('Product')['categories'];
            if (!is_array($categories)) $product->freeze = 1;

            if ($product->save()) {
                $classKnife->product_id = $product->id;
                $classType->product_id = $product->id;

                $productImage = new \app\helpers\ProductImage($product);
                $productImage->Save();

                if ( $classKnife->save() && $classType->save() ) {
                    // Categories
                    Yii::$app->db->createCommand()
                        ->delete('{{%product_to_category}}', ['product_id' => $product->id])
                        ->execute();

                    // If categories not empty
                    if ( $categories !== "" ) {
                        foreach ($categories as $categoryId) {
                            $category = Category::findOne($categoryId);
                            $product->link('categories', $category);
                        }
                    }

                    if (!$isAjax) Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Продукт успешно изменён!'));
                } else {

                    if (!$isAjax) Yii::$app->getSession()->setFlash('error', Yii::t('app',
                        "Класс ножа: ".print_r($classKnife->getErrors(), true)."; Типовой класс: ".print_r($classType->getErrors() , true)));
                }
            }
            else {
                if (!$isAjax) Yii::$app->getSession()->setFlash('error', Yii::t('app', print_r($product->getErrors(), true)));
            }

            if (Yii::$app->request->isAjax) {
                return "success!";
            } else {
                return $this->render('update', [
                    'product' => $product,
                    'classKnife' => $classKnife,
                    'classType' => $classType,
                ]);
            }
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('_form', [
                    'product' => $product,
                    'classKnife' => $classKnife,
                    'classType' => $classType,
                ]);
            }
            else {
                return $this->render('update', [
                    'product' => $product,
                    'classKnife' => $classKnife,
                    'classType' => $classType,
             ]);
         }
        }

    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
