# { json:api } Client Joomla

Используйте привычные модели Joomla, для работы с удалёнными ресурсами, по спецификации [JSON:API](http://jsonapi.org/).
Например, получайте данные по API с другого сайта, под управлением Joomla.

## Установка

``` bash
composer require webmasterskaya/json-api-client-joomla
```

### Подключите к своему компоненту

В сервис провайдере вашего компонента (файл `services/provider.php`) зарегистрируйте провайдер `MVCFactory` с поддержкой
JSON:API, сразу после регистрации основного провайдера `MVCFactory`

```php
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Webmasterskaya\JsonApi\Client\Joomla\Service\Provider\MVCFactoryWithJsonApiClient;

return new class implements ServiceProviderInterface {
    public function register(Container $container)
	{
        ...
        $container->registerServiceProvider(new MVCFactory('\\Joomla\\Component\\YourComponentName'));
        $container->registerServiceProvider(new MVCFactoryWithJsonApiClient());
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\Joomla\\Component\\YourComponentName'));
        ...
    }
}
```

### Реализуйте собственные модели, унаследовав базовые моделей

```php
class ArticleModel extends \Webmasterskaya\JsonApi\Client\Joomla\MVC\Model\ItemJsonApiModel {

}
```

```php
class ArticlesModel extends \Webmasterskaya\JsonApi\Client\Joomla\MVC\Model\ListJsonApiModel {

}
```

```php
class FormModel extends \Webmasterskaya\JsonApi\Client\Joomla\MVC\Model\FormJsonApiModel {

}
```

```php
class AdminModel extends \Webmasterskaya\JsonApi\Client\Joomla\MVC\Model\AdminJsonApiModel {

}
```