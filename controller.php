<?php
namespace Concrete\Package\EntitiesExample;

defined('C5_EXECUTE') or die(_("Access Denied."));

// Autoload needs to happen already here as we need the included libraries
// already in the package's extend statement. Too bad if we need different
// versions of the same library in multiple packages, the one that is loaded
// the first will always win. That's a widely acknowledged problem and there
// are some possible ways to solve it:

// Maybe some day built into composer:
// https://github.com/composer/composer/issues/183

// Drupal's way:
// https://www.drupal.org/project/composer_manager
// https://www.acquia.com/blog/using-composer-manager-get-island-now

// Hopefully we'll have some way of handling this in concrete5 as well at some point...
include(__DIR__ . '/vendor/autoload.php');

use Database;
use SinglePage;
use Package;
use Concrete\Core\Foundation\ClassLoader;

class Controller extends Package
{

    protected $pkgHandle = 'entities_example';
    protected $appVersionRequired = '5.7.4';
    protected $pkgVersion = '0.0.1';

    public function getPackageName()
    {
        return t("Entities Example");
    }

    public function getPackageDescription()
    {
        return t("Example of using Doctrine entities and proxies within the concrete5 package context.");
    }

    public function install()
    {
        // We need to register the autoloaders for the DB uninstallation to
        // work properly. This would not otherwise be done in the install
        // function. 
        ClassLoader::getInstance()->registerPackage($this->pkgHandle);

        // We only call this because we want a fresh database when we import
        // the example data there. Do not normally call this!
        $dbm = $this->getDatabaseStructureManager();
        $dbm->uninstallDatabase();

        $pkg = parent::install();

        $this->installSinglePages($pkg);
        $this->installData($pkg);
    }

    protected function installSinglePages($pkg)
    {
        $sp = SinglePage::add('/dashboard/entities_example', $pkg);
        $sp = SinglePage::add('/dashboard/entities_example/books', $pkg);
        $sp = SinglePage::add('/dashboard/entities_example/authors', $pkg);
    }

    protected function installData($pkg)
    {
        $em = $pkg->getEntityManager();
        $faker = \Faker\Factory::create();

        // Create a couple of authors
        $authors = array();
        for ($i = 0; $i < 5; $i++) {
            $author = new \Concrete\Package\EntitiesExample\Src\Entity\Author;
            $author->name = $faker->name;
            $em->persist($author);

            $authors[$i] = $author;
        }
        $authorKeys = array_keys($authors);

        // Create some books for the authors
        for ($i = 0; $i < rand(2, 10); $i++) {
            $book = new \Concrete\Package\EntitiesExample\Src\Entity\Book\Book;
            $book->name = ucwords(implode(" ", $faker->words(rand(3, 6))));
            $book->ISBN = $faker->ean13();

            // Books can have 1-count($authors) authors randomly selected from
            // the $authors array. Add the random amount of authors for this
            // book.
            shuffle($authorKeys);
            for ($j = 0; $j < rand(1, count($authorKeys)); $j++) {
                $book->addAuthor($authors[$authorKeys[$j]]);
            }

            $em->persist($book);

            // Create some pages for the book. We have quite short books but
            // it saves us time from the generation process which might take
            // quite long time with a large amount of pages.
            for ($j = 0; $j < rand(10, 20); $j++) {
                $page = new \Concrete\Package\EntitiesExample\Src\Entity\Book\Page;
                $page->text = implode("\n\n", $faker->paragraphs(rand(1,5)));
                $page->book = $book;
                $em->persist($page);
            }

            // Flush after every book
            $em->flush();
        }
    }

}

