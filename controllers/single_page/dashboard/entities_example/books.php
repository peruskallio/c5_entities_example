<?php
namespace Concrete\Package\EntitiesExample\Controller\SinglePage\Dashboard\EntitiesExample;

defined('C5_EXECUTE') or die("Access Denied.");

use Database;
use Package;
use \Concrete\Core\Page\Controller\DashboardPageController;

class Books extends DashboardPageController
{

    public function view($bookID = null, $pageNum = 1)
    {
        $rep = $this->getBookRepository();
        if ($bookID !== null) {
            $book = $rep->find($bookID);
            if (is_object($book)) {
                $this->set('book', $book);
                
                if ($pageNum < 1 || $pageNum > $book->getNumberOfPages()) {
                    $pageNum = 1;
                }
                // Retrieve only the text for the target page as an example of
                // using Doctrine proxy objects. This could also be done more
                // easily but we want to use proxies in this case.
                $q = $this->em()->createQuery('SELECT p FROM Concrete\Package\EntitiesExample\Src\Entity\Book\Page p');
                $q->setFirstResult($pageNum-1);
                $q->setMaxResults(1);

                $page = $q->getSingleResult();
                $this->set('page', $page);
                $this->set('pageNumber', $pageNum);
                $this->set('pagesTotal', $book->getNumberOfPages());
                if ($pageNum > 1) {
                    $this->set('prevPage', $pageNum-1);
                }
                if ($pageNum < $this->get('pagesTotal')) {
                    $this->set('nextPage', $pageNum+1);
                }
            } else {
                $this->redirect($this->c->getCollectionPath());
            }
        } else {
            $this->set('books', $rep->findAll());
        }
    }

    protected function getBookRepository()
    {
        return $this->em()->getRepository('Concrete\Package\EntitiesExample\Src\Entity\Book\Book');
    }

    protected function em()
    {
        return Package::getByID($this->c->getPackageID())->getEntityManager();
    }

}
