---
layout: article
language: 'en'
version: '3.2'
title: 'Phalcon\Mvc\Collection\ManagerInterface'
---
# Interface **Phalcon\Mvc\Collection\ManagerInterface**

<a href="https://github.com/phalcon/cphalcon/tree/v3.2.0/phalcon/mvc/collection/managerinterface.zep" class="btn btn-default btn-sm">Source on GitHub</a>

## Methods
abstract public  **setCustomEventsManager** ([Phalcon\Mvc\CollectionInterface](/3.2/en/api/Phalcon_Mvc_CollectionInterface) $model, [Phalcon\Events\ManagerInterface](/3.2/en/api/Phalcon_Events_ManagerInterface) $eventsManager)

...


abstract public  **getCustomEventsManager** ([Phalcon\Mvc\CollectionInterface](/3.2/en/api/Phalcon_Mvc_CollectionInterface) $model)

...


abstract public  **initialize** ([Phalcon\Mvc\CollectionInterface](/3.2/en/api/Phalcon_Mvc_CollectionInterface) $model)

...


abstract public  **isInitialized** (*mixed* $modelName)

...


abstract public  **getLastInitialized** ()

...


abstract public  **setConnectionService** ([Phalcon\Mvc\CollectionInterface](/3.2/en/api/Phalcon_Mvc_CollectionInterface) $model, *mixed* $connectionService)

...


abstract public  **useImplicitObjectIds** ([Phalcon\Mvc\CollectionInterface](/3.2/en/api/Phalcon_Mvc_CollectionInterface) $model, *mixed* $useImplicitObjectIds)

...


abstract public  **isUsingImplicitObjectIds** ([Phalcon\Mvc\CollectionInterface](/3.2/en/api/Phalcon_Mvc_CollectionInterface) $model)

...


abstract public  **getConnection** ([Phalcon\Mvc\CollectionInterface](/3.2/en/api/Phalcon_Mvc_CollectionInterface) $model)

...


abstract public  **notifyEvent** (*mixed* $eventName, [Phalcon\Mvc\CollectionInterface](/3.2/en/api/Phalcon_Mvc_CollectionInterface) $model)

...


abstract public  **addBehavior** ([Phalcon\Mvc\CollectionInterface](/3.2/en/api/Phalcon_Mvc_CollectionInterface) $model, [Phalcon\Mvc\Collection\BehaviorInterface](/3.2/en/api/Phalcon_Mvc_Collection_BehaviorInterface) $behavior)

...

