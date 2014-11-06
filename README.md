# Example of using Doctrine entities within a concrete5 package

Since version 5.7.0 concrete5 has shipped with the Doctrine DBAL and ORM
libraries. This makes it possible to use Doctrine entities within concrete5
packages which makes a lot of things easier in terms of accessing the entities
stored in the database.

However, currently concrete5 (5.7.2) does not provide any utilities or
guidelines on how to use these entities within the package context. Therefore,
it is required to add some functionality to the package class to make all this
possible and easier to manage.

The required functionality is provided by the following 
[Composer](https://getcomposer.org/) package:

https://github.com/mainio/c5pkg_dbentities

This is an example implementation on how to use that package and the Doctrine
entities within a concrete5 package. 


## How to use

1. Download this repository
2. Extract all contents of the repository to your /packages folder within a
   package folder named `entities_example`.
3. Make sure you have [Composer](https://getcomposer.org/) installed
4. Open your console and navigate to the pacakge folder
5. Install the composer packages by running `composer install`
6. Navigate to your site's dashboard and install this package

When doing any further development on the package or modifying the Entity
classes (located in `src/Entity`), make sure you add this configuration to your
`/config/app.php`:

```php
return array(
    // ...
    'package_dev_mode' => true,
    // ...
);
```

This enables the auto generation of the proxy classes to your package folder.
The auto generation is run always when the pacakge is installed or upgraded
and that setting is enabled.


## License

Licensed under the MIT license. See LICENSE for more information.

Copyright (c) 2014 Mainio Tech Ltd.