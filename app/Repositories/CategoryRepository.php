<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\BaseRepository;

/**
 * @codeCoverageIgnore
 */
class CategoryRepository extends BaseRepository
{
    /**
     * @var \App\Models\Category
     */
    protected $model;

    /**
     * Constructor.
     * @param \App\Models\Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * Get table primary key. 
     */
    public function primaryKey(): string 
    {
        return $this->model->getKeyName();
    }

    /**
     * Get table name.
     * 
     * @return string
     */
    public function tableName(): string
    {
        return $this->model->getTable();
    }

    /**
     * Get model.
     * 
     * @return \App\Models\Category
     */
    public function model(): Category
    {
        return $this->model;
    }    
}