<?php
namespace Concrete\Package\EntitiesExample\Src\Entity\Book;

defined('C5_EXECUTE') or die(_("Access Denied."));

use Mainio\C5\Entity\Entity;

/**
 * @Entity
 * @Table(name="EntitiesExampleBookPages")
 */
class Page extends Entity
{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $pageID;

    /**
     * @Column(type="text")
     */
    protected $text;

    /**
     * @ManyToOne(targetEntity="Concrete\Package\EntitiesExample\Src\Entity\Book\Book", inversedBy="pages")
     * @JoinColumn(name="bookID", referencedColumnName="bookID")
     **/
    protected $book;

    public function getWordCount()
    {
        return str_word_count($this->text);
    }

}
