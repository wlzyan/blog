<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Post Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'category_id',
            'category_name',
            'category_keyword',
            'category_descript',
            'category_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
