<?php

namespace App\Services;

use App\Models\Notice;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Repositories\NoticeRepository;

class NoticeService 
{

  /**
   * @var App\Repositories\NoticeRepository
   */
  protected $noticeRepository;

  /**
   * Constructor.
   * 
   * @param App\Repositories\NoticeRepository $noticeRepository
   */
  public function __construct(NoticeRepository $noticeRepository)
  {
    $this->noticeRepository = $noticeRepository;
  }

  /**
   * Get all.
   * 
   * @return \Illuminate\Support\Collection<Model>
   */
  public function getAll(): Collection
  {
    return $this->noticeRepository->getAll();
  }

  
  /**
   * Create new.
   * 
   * @param array<int> $data
   * @return string
   */
  public function create(array $data): string
  {
    return $this->noticeRepository->create([
      'name'        => Arr::get($data, 'name'),
      'description'  => Arr::get($data, 'description'),
      'category_id'  => Arr::get($data, 'category_id')
    ]);

  
  }
  
  /**
   * Find by id.
   * 
   * @param int $id
   * @return \App\Models\Notice
   */
  public function findById(int $id): Notice
  {
    return $this->noticeRepository->findById($id);
  }

  /**
   * Delete.
   * 
   * @param \App\Models\Notice $notice
   * @return void
   */
  public function delete(int $noticeId): void
  {
    $this->noticeRepository->delete(
      $noticeId,
      'id'
    );
  }

  /**
   * Update sequence.
   * 
   * @param int $noticeId
   * @param array $data
   * @return void
   */
  public function update(int $noticeId, array $data): void
  {
    $notice = $this->findById($noticeId);

    $this->noticeRepository->update(
      $notice->id,
      [
        'name'        => Arr::get($data, 'name') ?: $notice->name,
        'description'  => Arr::get($data, 'description') ?: $notice->description,
        'category_id'  => Arr::get($data, 'category_id') ?: $notice->category_id
      ],
      'id'
    );
  }
 
}
