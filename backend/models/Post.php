<?php

namespace backend\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "post".
 *
 * @property integer $post_id
 * @property integer $post_author
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $post_title
 * @property integer $post_category
 * @property string $post_keywords
 * @property string $post_excerpt
 * @property integer $post_status
 * @property string $post_url_name
 * @property integer $post_content_type
 * @property string $post_content
 * @property string $post_content_1 用于编辑页面传递富文本编辑器内容
 * @property string $post_content_2 用于编辑页面传递markdown编辑器内容
 * @property integer $post_hits
 * @property string $post_pic
 * @property string $post_tips
 * @property string $post_old_tips
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at' ,'updated_at','post_title', 'post_category', 'post_url_name', 'post_content'], 'required'],
            [['post_author', 'updated_at', 'post_category','post_content_type', 'post_status', 'post_hits'], 'integer'],
            [['post_title', 'post_excerpt', 'post_url_name', 'post_content', 'post_pic', 'post_tips'], 'string'],
            [['post_keywords'], 'string', 'max' => 255],
        ];
    }

    /*
    * 暂停使用，因为更新文章点击数时会触发时间更新
    * 自动以当前时间戳填充文章更新时间，updated_at为默认字段，不用再次指定。
    */
    // public function behaviors()
    // {
    //     return [
    //                [
    //                    'class' => TimestampBehavior::className(),
    //                    'createdAtAttribute' => false,//不填充发布日期
    //                ],
    //      ];
    // }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => '文章id',
            'post_author' => '作者id',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'post_title' => '标题',
            'post_category' => '分类',
            'post_keywords' => '文章seo关键字',
            'post_excerpt' => '简介',
            'post_status' => 'Post Status',
            'post_url_name' => 'url名称，用作个性化文章网址',
            'post_content_type' => '文章解析格式（1:html富文本，2:markdown格式）',
            'post_content' => '正文',
            'post_hits' => '点击数',
            'post_pic' => '栏目页展示图片',
        ];
    }

    public function getPost_content_1()
    {
        return  $this->post_content;
    }
    public function getPost_content_2()
    {
        return  $this->post_content;
    }
    public function getPost_old_tips()
    {
        return  $this->post_tips;
    }
    public function setPost_content_1($value)
    {
        $this->post_content_1 = $value;
    }
    public function setPost_content_2($value)
    {
        $this->post_content_2 = $value;
    }
    /**
* 保存数据前处理发布日期字段,添加作者信息
*/
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // 添加作者信息
      if ($this->isNewRecord) {
          $this->post_author = Yii::$app->user->getId();
      }
            // 将发布日期转换为时间戳
            // $this->created_at = strtotime($this->created_at);
            return true;
        } else {
            return false;
        }
    }
}
