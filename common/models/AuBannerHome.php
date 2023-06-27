<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use common\helper\StringHelper;
use yii\helpers\Url;
/**
 * This is the model class for table "au_banner_home".
 *
 * @property int $id
 * @property int $type 1 image, 2 video
 * @property string $path
 * @property string $create
 * @property string $status
 * @property string $create_by
 */
class AuBannerHome extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'au_banner_home';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['path'], 'string', 'max' => 100],
            [['create','create_by','status'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '1 image, 2 video',
            'path' => 'Path',
            'create' => 'Date create',
            'create_by' => 'Create by',
            'status' => 'Create by',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AuBannerHomeQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new AuBannerHomeQuery(get_called_class());
    // }
}
