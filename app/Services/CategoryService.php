<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Repositories\CategoryRepository;

class CategoryService 
{

  /**
   * @var App\Repositories\CategoryRepository
   */
  protected $categoryRepository;

  /**
   * Constructor.
   * 
   * @param App\Repositories\CategoryRepository $categoryRepository
   */
  public function __construct(CategoryRepository $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }

  /**
   * Get all.
   * 
   * @return \Illuminate\Support\Collection<Model>
   */
  public function getAll(): Collection
  {
    return $this->categoryRepository->getAll();
  }

  
  /**
   * Create new.
   * 
   * @param array<int> $data
   * @return string
   */
  public function create(array $data): string
  {
    return $this->categoryRepository->create([
      'name'        => Arr::get($data, 'name')
    ]);

  
  }
  
  /**
   * Find by id.
   * 
   * @param int $id
   * @return \App\Models\Category
   */
  public function findById(int $id): Category
  {
    return $this->categoryRepository->findById($id);
  }

  /**
   * Delete.
   * 
   * @param \App\Models\Category $category
   * @return void
   */
  public function delete(int $categoryId): void
  {
    $this->categoryRepository->delete(
      $categoryId,
      'id'
    );
  }

  /**
   * Update sequence.
   * 
   * @param int $categoryId
   * @param array $data
   * @return void
   */
  public function update(int $categoryId, array $data): void
  {
    $category = $this->findById($categoryId);

    $this->categoryRepository->update(
      $category->id,
      [
        'name' => Arr::get($data, 'name') ?: $category->name
      ],
      'id'
    );
  }
 
}
