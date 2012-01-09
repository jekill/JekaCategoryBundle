<?php

namespace Jeka\CategoryBundle\Document;

interface CategoryManagerInterface
{
    public function createCategory();
    function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    function getRoot();
    function findBySlug($slug);
    function findCategoryById($id);
    function updateCategory(Category $category, $andFlush = true);
}
