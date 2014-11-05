<?php
namespace Concrete\Package\EntitiesExample\Controller\SinglePage\Dashboard;

defined('C5_EXECUTE') or die("Access Denied.");

use \Concrete\Core\Page\Controller\DashboardPageController;

class EntitiesExample extends DashboardPageController
{

    public function view()
    {
        $this->redirect('/dashboard/entities_example/books');
    }

}
