<?php

namespace fonclub\i18n;
use yii\i18n;

use Yii;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\caching\Cache;
use yii\db\Connection;
use yii\db\Query;
use fonclub\i18n\models\I18n as i18nModel;

/**
 * Class DbMessageSource
 * @package fonclub\i18n
 * CREATE TABLE IF NOT EXISTS `i18n` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`category` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
`source` text COLLATE utf8_unicode_ci NOT NULL,
`message` text COLLATE utf8_unicode_ci,
`locale` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 */

class DbMessageSource extends \yii\i18n\MessageSource
{
    /**
     * Prefix which would be used when generating cache key.
     */
    const CACHE_KEY_PREFIX = 'DbMessageSource';

    /**
     * @var Connection|array|string the DB connection object or the application component ID of the DB connection.
     * After the DbMessageSource object is created, if you want to change this property, you should only assign
     * it with a DB connection object.
     * Starting from version 2.0.2, this can also be a configuration array for creating the object.
     */
    public $db = 'db';
    /**
     * @var Cache|array|string the cache object or the application component ID of the cache object.
     * The messages data will be cached using this cache object. Note, this property has meaning only
     * in case [[cachingDuration]] set to non-zero value.
     * After the DbMessageSource object is created, if you want to change this property, you should only assign
     * it with a cache object.
     * Starting from version 2.0.2, this can also be a configuration array for creating the object.
     */
    public $cache = 'cache';
    /**
     * @var string the name of the translated message table.
     */
    public $messageTable = '{{%message}}';
    /**
     * @var integer the time in seconds that the messages can remain valid in cache.
     * Use 0 to indicate that the cached data will never expire.
     * @see enableCaching
     */
    public $cachingDuration = 0;
    /**
     * @var boolean whether to enable caching translated messages
     */
    public $enableCaching = false;


    /**
     * Initializes the DbMessageSource component.
     * This method will initialize the [[db]] property to make sure it refers to a valid DB connection.
     * Configured [[cache]] component would also be initialized.
     * @throws InvalidConfigException if [[db]] is invalid or [[cache]] is invalid.
     */
    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::className());
        if ($this->enableCaching) {
            $this->cache = Instance::ensure($this->cache, Cache::className());
        }
    }

    /**
     * Loads the message translation for the specified language and category.
     * If translation for specific locale code such as `en-US` isn't found it
     * tries more generic `en`.
     *
     * @param string $category the message category
     * @param string $language the target language
     * @return array the loaded messages. The keys are original messages, and the values
     * are translated messages.
     */
    protected function loadMessages($category, $language)
    {
        if ($this->enableCaching) {
            $key = [
                __CLASS__,
                $category,
                $language,
            ];
            $messages = $this->cache->get($key);
            if ($messages === false) {
                $messages = $this->loadMessagesFromDb($category, $language);
                $this->cache->set($key, $messages, $this->cachingDuration);
            }

            return $messages;
        } else {
            return $this->loadMessagesFromDb($category, $language);
        }
    }

    /**
     * Loads the messages from database.
     * You may override this method to customize the message storage in the database.
     * @param string $category the message category.
     * @param string $language the target language.
     * @return array the messages loaded from database.
     */
    protected function loadMessagesFromDb($category, $language)
    {
        $messages = i18nModel::findAll(['category' => $category, 'locale' => $language]);

        return ArrayHelper::map($messages, 'source', 'message');
    }
}
