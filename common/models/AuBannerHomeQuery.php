<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AuBannerHome]].
 *
 * @see AuBannerHome
 */
class AuBannerHomeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AuBannerHome[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AuBannerHome|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
