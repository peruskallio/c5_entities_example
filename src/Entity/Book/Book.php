<?php
namespace Concrete\Package\EntitiesExample\Src\Entity\Book;

defined('C5_EXECUTE') or die(_("Access Denied."));

use Concrete\Package\EntitiesExample\Src\Entity;

/**
 * @Entity
 * @Table(name="EntitiesExampleBooks")
 */
class Book extends Entity
{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $bookID;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @Column(type="string", length=64, nullable=false)
     */
    protected $ISBN;

    /**
     * @OneToMany(targetEntity="Concrete\Package\EntitiesExample\Src\Entity\Book\Page", mappedBy="book")
     **/
     protected $pages;

    /**
     * @ManyToMany(targetEntity="Concrete\Package\EntitiesExample\Src\Entity\Author", mappedBy="books")
     **/
    protected $authors;

    public function addAuthor(\Concrete\Package\EntitiesExample\Src\Entity\Author $author) {
        $author->addBook($this);
    }

    public function addPage(\Concrete\Package\EntitiesExample\Src\Entity\Book\Page $page) {
        $page->book = $this;
    }

    public function getNumberOfPages()
    {
        return $this->pages->count();
    }

    public function getNumberOfAuthors()
    {
        return $this->authors->count();
    }

    public function getISBNFormatted()
    {
        $formatted = "";
        $format = array(3, 1, 5, 3, 1);
        $pos = 0;
        foreach ($format as $num) {
            if ($pos > 0) {
                $formatted .= '-';
            }
            $formatted .= substr($this->ISBN, $pos, $num);
            $pos += $num;
        }
        return $formatted;
    }

}
