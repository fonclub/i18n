<?php

namespace fonclub\i18n\models;

use Yii;

/**
 * This is the model class for table "{{%i18n}}".
 *
 * @property integer $id
 * @property string $category
 * @property string $source
 * @property string $message
 * @property string $locale
 */
class I18n extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%i18n}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['source', 'locale'], 'required'],
            [['source', 'message'], 'string'],
            [['category'], 'string', 'max' => 32],
            [['locale'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('i18n', 'ID'),
            'category' => Yii::t('i18n', 'Category'),
            'source' => Yii::t('i18n', 'Source'),
            'message' => Yii::t('i18n', 'Message'),
            'locale' => Yii::t('i18n', 'Locale'),
        ];
    }
}
