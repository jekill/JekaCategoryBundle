<?php
namespace Jeka\CategoryBundle\Document;

use \Doctrine\ODM\MongoDB\DocumentManager;

class CategoryManager implements CategoryManagerInterface
{
    private $dm;
    private $repository;
    private $categoryClass;

    public function __construct(DocumentManager $dm, $categoryClass)
    {
        $this->dm = $dm;
        $this->categoryClass = $categoryClass;
        $this->repository = $this->dm->getRepository($categoryClass);
    }

    /**
     * @return \Jeka\CategoryBundle\Document\Category
     */
    public function getRoot()
    {
        return $this->repository->findOneBy(array('slug' => 'root'));
    }

    /**
     * @return array
     */
    public function getTreeList()
    {
        $tree = array();
        $root = $this->getRoot();
        $tree[] = $root;
        $this->_addChildren($root, $tree);
        return $tree;
    }

    private function _addChildren($root, &$tree)
    {
        foreach ($this->findChildren($root) as $cat)
        {
            $tree[] = $cat;
            $this->_addChildren($cat, $tree);
        }
    }

    /**
     * @return \Jeka\CategoryBundle\Document\Category
     */
    public function createCategory()
    {
        return new $this->categoryClass;
    }

    /**
     * Find a collection of categories by the criteria
     *
     * @param array $criteria
     * @param mixed $orderBy
     * @param mixed $limit
     * @param mixed $offset
     *
     * @return array
     */
    function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        // TODO: Implement findBy() method.
    }

    /**
     * @param $id
     * @return \Jeka\CategoryBundle\Document\Category
     */
    function findCategoryById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param Category $category
     * @param bool $andFlush
     */
    function updateCategory(Category $category, $andFlush = true)
    {
        $this->dm->persist($category);
        if ($andFlush) {
            $this->dm->flush();
        }
    }

    function findBySlug($slug)
    {
        return $this->repository->findOneBy(array('slug' => $slug));
    }

    function findChildren(Category $category)
    {
        return $this->repository->createQueryBuilder()
            ->field('parent.id')->equals($category->getId())
            ->sort('position', 'asc')
            ->getQuery()
            ->execute();

    }


    public function findDescendants($category)
    {
        return $this->repository->createQueryBuilder()
            ->field('ancestors.id')->equals($category->getId())
        //->sort('pos','asc')
            ->getQuery()
            ->execute();
    }

    public function flushManager()
    {
        $this->dm->flush();
    }


    public function normalizePositions($root = null)
    {
        $root = !$root ? $this->getRoot() : $root;
        $index = 0;
        foreach($this->findChildren($root) as $child)
        {
            $child->setPosition($index++);
            $this->updateCategory($child,false);
            $this->normalizePositions($child);
        }
        $this->flushManager();
    }

    public function remove(Category $category)
    {
        $this->dm->remove($category);
        $this->flushManager();
    }
}
