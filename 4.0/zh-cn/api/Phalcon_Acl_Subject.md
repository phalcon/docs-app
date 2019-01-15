---
layout: article
language: 'zh-cn'
version: '4.0'
title: 'Phalcon\Acl\Subject'
---
# Class [Phalcon\Acl\Subject](/4.0/en/api/Phalcon_Acl_Subject)

**implements**{:.c-mod} [Phalcon\Acl\SubjectInterface](/4.0/en/api/Phalcon_Acl_SubjectInterface)

<a href="https://github.com/phalcon/cphalcon/tree/v4.0.0/phalcon/acl/subject.zep" class="btn btn-default btn-sm">源码在GitHub</a>

This class defines a subject entity and its description

## 方法

```php
public __construct( string $name [, string $description = NULL] )
```

Phalcon\Acl\Subject constructor

* * *

```php
public getDescription(): string
```

Subject description

* * *

```php
public getName(): string
```

Subject name

* * *

```php
public __toString(): string
```

Subject name

* * *