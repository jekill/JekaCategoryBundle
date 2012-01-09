<?php

namespace Jeka\CategoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoryController extends Controller
{
    /**
     * @Route("/categoriesTree/", name="categories_tree")
     * @Template()
     */
    public function treeAction()
    {
        /** @var $cm \Jeka\CategoryBundle\Document\CategoryManager */
        $cm = $this->get('jeka.category_manager');
        return array('root'=>$cm->getRoot());
    }
}
