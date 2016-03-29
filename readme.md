# A Dependency Injection solution from scratch

Here are some notes about what we aim to achieve:

##### Comply with the PSR-11 standard
* Use the container-interop/container-interop package
* https://packagist.org/packages/container-interop/container-interop

##### Write the code in TDD style with PHPUnit
* https://packagist.org/packages/phpunit/phpunit

##### Have a container where we can store services ( = object definitions)
* The object definitions are instances of a Definition class which has class and args properties
* The constructor is used to set the services
* The container is immutable
* The container's has() method tells whether a given identifier exists in the container
* The container's get() method returns an object that is instantiated based on its definition
* Lazy loading: we instantiate an object only when we have to (when someone asks for it via the get() method)
* Object storage: we instantiate an object only once and then store it

##### Create a builder class
* Resolves all the dependencies in the tree and then compiles the Container class

##### Auto wiring