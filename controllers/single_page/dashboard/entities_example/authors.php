<?php
namespace Concrete\Package\EntitiesExample\Controller\SinglePage\Dashboard\EntitiesExample;

defined('C5_EXECUTE') or die("Access Denied.");

use Package;
use \Concrete\Core\Page\Controller\DashboardPageController;

class Authors extends DashboardPageController
{

    public function view($authorID = null)
    {
        $rep = $this->getAuthorRepository();
        if ($authorID !== null) {
            $author = $rep->find($authorID);
            if (is_object($author)) {
                $this->set('author', $author);
            } else {
                $this->redirect($this->c->getCollectionPath());
            }
        } else {
            $this->set('authors', $rep->findAll());
        }
    }

    protected function getAuthorRepository()
    {
        return $this->em()->getRepository('Concrete\Package\EntitiesExample\Src\Entity\Author');
    }

    protected function em()
    {
        return Package::getByID($this->c->getPackageID())->getEntityManager();
    }


}
