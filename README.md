# Example of using Doctrine entities within a concrete5 package

Since version 5.7.0 concrete5 has shipped with the Doctrine DBAL and ORM
libraries. This makes it possible to use Doctrine entities within concrete5
packages which makes a lot of things easier in terms of accessing the entities
stored in the database.

In 5.7.4 our implementation of the utilities that are necessary to take
advantage of the Doctrine entities within a package context was merged into
the core.

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
classes (located in `src/Entity`), make sure you have the Doctrine
development mode enabled. You can enable this from:
Dashboard > System & Settings > Environment > Database Entities > Doctrine Development Mode

This enables the auto generation of the proxy classes to your system's
application/config folder. The auto generation is run always when the pacakge
is installed or upgraded and that setting is enabled.


## License

Licensed under the MIT license. See LICENSE for more information.

Copyright (c) 2014 Mainio Tech Ltd.