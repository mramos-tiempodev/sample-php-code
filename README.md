# Show two modules for code sample #
Basically this is a API based on ZF2, the main module is Wall, as you can see there is a config file
**Wall/config/module.config.php**  this file manipulates what controllers, factories, views and basically any 
configuration that can be called.

ZF uses the service manager pattern to load controllers, services, factories and other resources from your system, in
this case we are loading **Wall/src/Controller/IndexControllerFactory.php** file, used to inject all the dependencies 
that the IndexController.php file has, in this case a class that is in other module.

The way to invoke an object is this one
```php
$userGraphTable = $serviceManager->get('Tecaz.UserGraphTable');
```

As you can see we are using the $serviceManager pattern, to load the class UserGraphTable.php that is in _User_ module
This way we can inject the dependency that the IndexController class from Wall module requires

So the way that the application runs is the next, as this is an API, the client (that is not included here) will request 
a get method from the IndexController inside Wall module, when this happen, ZF will detect that IndexController is 
called from the IndexControllerFactory so, this will be loaded before the client's call, (this is done by the framework) 
and will inject the dependency, this way the controller will be ready to use **UserGraphTable** from _User_ module.


