---
layout: article
language: 'ru-ru'
version: '4.0'
---

<a name='overview'></a>

# Чтение конфигураций

[Phalcon\Config](api/Phalcon_Config) is a component used to convert configuration files of various formats (using adapters) into PHP objects for use in an application.

Значения могут быть получены из `Phalcon\Config` следующим образом:

```php
<?php

use Phalcon\Config;

$config = new Config(
    [
        'test' => [
            'parent' => [
                'property'  => 1,
                'property2' => 'yeah',
            ],
        ],  
    ]
);

echo $config->get('test')->get('parent')->get('property');  // выведет 1
echo $config->test->parent->property;                       // выведет 1
echo $config->path('test.parent.property');                 // выведет 1
```

<a name='factory'></a>

## Фабрика

Loads Config Adapter class using `adapter` option, if no extension is provided it will be added to `filePath`

```php
<?php

use Phalcon\Config\Factory;

$options = [
    'filePath' => 'path/config',
    'adapter'  => 'php',
 ];

 $config = Factory::load($options);
 ```

<a name='native-arrays'></a>
## Native Arrays
The first example shows how to convert native arrays into [Phalcon\Config](api/Phalcon_Config) objects. This option offers the best performance since no files are read during this request.

```php
<?php

use Phalcon\Config;

$settings = [
    'database' => [
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'scott',
        'password' => 'cheetah',
        'dbname'   => 'test_db'
    ],
     'app' => [
        'controllersDir' => '../app/controllers/',
        'modelsDir'      => '../app/models/',
        'viewsDir'       => '../app/views/'
    ],
    'mysetting' => 'the-value'
];

$config = new Config($settings);

echo $config->app->controllersDir, "\n";
echo $config->database->username, "\n";
echo $config->mysetting, "\n";
```

If you want to better organize your project you can save the array in another file and then read it.

```php
<?php

use Phalcon\Config;

require 'config/config.php';

$config = new Config($settings);
```

<a name='file-adapter'></a>

## Файловые адаптеры

The adapters available are:

| Класс                                                             | Описание                                                                                            |
| ----------------------------------------------------------------- | --------------------------------------------------------------------------------------------------- |
| [Phalcon\Config\Adapter\Ini](api/Phalcon_Config_Adapter_Ini)   | Использует INI-файлы для хранения конфигурации. Использует PHP-функцию `parse_ini_file`.            |
| [Phalcon\Config\Adapter\Json](api/Phalcon_Config_Adapter_Json) | Использует JSON-файлы для хранения конфигурации.                                                    |
| [Phalcon\Config\Adapter\Php](api/Phalcon_Config_Adapter_Php)   | Использует многомерные PHP-массивы для хранения конфигурации. Этот адаптер наиболее производителен. |
| [Phalcon\Config\Adapter\Yaml](api/Phalcon_Config_Adapter_Yaml) | Использует YAML-файлы для хранения конфигурации.                                                    |

<a name='ini-files'></a>

## Чтение INI-файлов

Ini files are a common way to store settings. [Phalcon\Config](api/Phalcon_Config) uses the optimized PHP function `parse_ini_file` to read these files. Files sections are parsed into sub-settings for easy access.

```ini
[database]
adapter  = Mysql
host     = localhost
username = scott
password = cheetah
dbname   = test_db

[phalcon]
controllersDir = '../app/controllers/'
modelsDir      = '../app/models/'
viewsDir       = '../app/views/'

[models]
metadata.adapter  = 'Memory'
```

You can read the file as follows:

```php
<?php

use Phalcon\Config\Adapter\Ini as ConfigIni;

$config = new ConfigIni('path/config.ini');

echo $config->phalcon->controllersDir, "\n";
echo $config->database->username, "\n";
echo $config->models->metadata->adapter, "\n";
```

<a name='merging'></a>

## Объединение конфигураций

[Phalcon\Config](api/Phalcon_Config) can recursively merge the properties of one configuration object into another. New properties are added and existing properties are updated.

```php
<?php

use Phalcon\Config;

$config = new Config(
    [
        'database' => [
            'host'   => 'localhost',
            'dbname' => 'test_db',
        ],
        'debug' => 1,
    ]
);

$config2 = new Config(
    [
        'database' => [
            'dbname'   => 'production_db',
            'username' => 'scott',
            'password' => 'secret',
        ],
        'logging' => 1,
    ]
);

$config->merge($config2);

print_r($config);
```

The above code produces the following:

```bash
Phalcon\Config Object
(
    [database] => Phalcon\Config Object
        (
            [host] => localhost
            [dbname]   => production_db
            [username] => scott
            [password] => secret
        )
    [debug] => 1
    [logging] => 1
)
```

There are more adapters available for this components in the [Phalcon Incubator](https://github.com/phalcon/incubator)

<a name='nested-configuration'></a>

## Вложенная конфигурация

Также, чтобы получить вложенную конфигурацию, можно воспользоваться методом `Phalcon\Config::path`. Этот метод позволяет получить вложенную конфигурацию, не беспокоясь о том, что некоторые части пути отсутствуют. Let's look at an example:

```php
<?php

use Phalcon\Config;

$config = new Config(
   [
        'phalcon' => [
            'baseuri' => '/phalcon/'
        ],
        'models' => [
            'metadata' => 'memory'
        ],
        'database' => [
            'adapter'  => 'mysql',
            'host'     => 'localhost',
            'username' => 'user',
            'password' => 'passwd',
            'name'     => 'demo'
        ],
        'test' => [
            'parent' => [
                'property' => 1,
                'property2' => 'yeah'
            ],
        ],
   ]
);

// Использование точки в качетсве разделителя
$config->path('test.parent.property2');    // yeah
$config->path('database.host', null, '.'); // localhost

$config->path('test.parent'); // Phalcon\Config

// Использование слэша в качестве разделителя. Также, может быть указано значение по умолчанию
// которое будет возвращено если раздела конфигурации не существует.
$config->path('test/parent/property3', 'no', '/'); // no

Config::setPathDelimiter('/');
$config->path('test/parent/property2'); // yeah
```

Следующий пример показывает, один из способов создания фасада, для получения вложенной конфигурации:

```php
<?php

use Phalcon\Di;
use Phalcon\Config;

/**
 * @return mixed|Config
 */
function config() {
    $args = func_get_args();
    $config = Di::getDefault()->getShared(__FUNCTION__);

    if (empty($args)) {
       return $config;
    }

    return call_user_func_array([$config, 'path'], $args);
}
```

<a name='injecting-into-di'></a>

## Внедрение зависимости конфигурации

You can inject your configuration to the controller allowing us to use [Phalcon\Config](api/Phalcon_Config) inside [Phalcon\Mvc\Controller](api/Phalcon_Mvc_Controller). Для этого вам необходимо добавить конфигурацию как сервис в контейнер зависимостей приложения. Добавьте следующий код в ваш сервис-провайдер:

```php
<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Config;

// Create a DI
$di = new FactoryDefault();

$di->set(
    'config',
    function () {
        $configData = require 'config/config.php';

        return new Config($configData);
    }
);
```

Now in your controller you can access your configuration by using dependency injection feature using name `config` like following code:

```php
<?php

use Phalcon\Mvc\Controller;

class MyController extends Controller
{
    private function getDatabaseName()
    {
        return $this->config->database->dbname;
    }
}
```