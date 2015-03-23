fonclub/i18n
===================

Модуль для хранения локализации в БД

Установка
------------

##### Запустить 
```
php composer.phar require --prefer-dist "fonclub/i18n" "dev-master"
```

или добавить в  `composer.json:`

```
"fonclub/i18n": "dev-master"
```

##### Используем модуль

```

<?php
    ......
    'modules' => [
        'i18n' => [
            'class' => 'fonclub\i18n\Module',
        ],
    ],
    ......
    ......
    'components' => [    
            'i18n' => [
                'translations' => [
                    '*'=> [
                        'class' => 'fonclub\i18n\DbMessageSource',
                        'messageTable'=>'{{%i18n}}',
                        'enableCaching' => true,
                        'cachingDuration' => 3600
                    ],
                ],
            ],
    ......
```