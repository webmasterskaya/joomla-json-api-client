# { json:api } Client Joomla

Используйте привычные модели Joomla, для работы с удалёнными ресурсами, по спецификации [JSON:API](http://jsonapi.org/).
Например, получайте данные по API с другого сайта, под управлением Joomla.

## Установка

``` bash
composer require webmasterskaya/json-api-client-joomla
```

### Подключите к своему компоненту

В сервис провайдере вашего компонента (файл `services/provider.php`) зарегистрируйте провайдер 
`\Webmasterskaya\JsonApi\Client\Service\Provider\MVCFactory` 
с поддержкой JSON:API, вместо провайдера из ядра Joomla CMS
`Joomla\CMS\Extension\Service\Provider\MVCFactory`

```php
return new class implements \Joomla\DI\ServiceProviderInterface {
    public function register(\Joomla\DI\Container $container)
	{
        ...
        $container->registerServiceProvider(new \Webmasterskaya\JsonApi\Client\Service\Provider\MVCFactory('\\Joomla\\Component\\YourComponentName'));
        $container->registerServiceProvider(new \Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory('\\Joomla\\Component\\YourComponentName'));
        ...
    }
}
```

### Реализуйте собственные модели для работы с JSON:API

```php
class ArticleModel extends \Webmasterskaya\JsonApi\Client\MVC\Model\ItemJsonApiModel {

}
```

```php
class ArticlesModel extends \Webmasterskaya\JsonApi\Client\MVC\Model\ListJsonApiModel {

}
```

```php
class FormModel extends \Webmasterskaya\JsonApi\Client\MVC\Model\FormJsonApiModel {

}
```

```php
class AdminModel extends \Webmasterskaya\JsonApi\Client\MVC\Model\AdminJsonApiModel {

}
```