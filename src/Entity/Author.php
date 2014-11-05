<?php
namespace Concrete\Package\EntitiesExample\Src\Entity;

defined('C5_EXECUTE') or die(_("Access Denied."));

use Mainio\C5\Entity\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="EntitiesExampleAuthors")
 */
class Author extends Entity
{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $authorID;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @ManyToMany(targetEntity="Concrete\Package\EntitiesExample\Src\Entity\Book\Book", inversedBy="authors")
     * @JoinTable(name="EntitiesExampleAuthorBooks",
     *      joinColumns={@JoinColumn(name="bookID", referencedColumnName="authorID")},
     *      inverseJoinColumns={@JoinColumn(name="authorID", referencedColumnName="bookID")}
     *      )
     **/
    protected $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function addBook(\Concrete\Package\EntitiesExample\Src\Entity\Book\Book $book) {
        $this->books[] = $book;
    }

    public function getNumberOfBooks()
    {
        return $this->books->count();
    }

}
