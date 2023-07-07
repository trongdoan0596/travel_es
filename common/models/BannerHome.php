<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "au_banner_home".
 *
 * @property int $id
 * @property int $type 1 image, 2 video
 * @property string $path
 * @property string $create
 * @property int $created_by
 * @property int $status 1 show, 2 hide
 */
class BannerHome extends \yii\db\ActiveRecord
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
            [['type', 'created_by', 'status'], 'integer'],
            [['status','position'], 'required'],
            [['create'], 'safe'],
            [['path'], 'string', 'max' => 100],
            [['path'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg,mp4'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type banner',
            'path' => 'Path',
            'create' => 'Create',
            'created_by' => 'Created By',
            'status' => 'Status',
            'position' => 'Position',
        ];
    }

}
