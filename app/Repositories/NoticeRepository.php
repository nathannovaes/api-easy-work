<?php

namespace App\Repositories;

use App\Models\Notice;
use App\Repositories\BaseRepository;

class NoticeRepository extends BaseRepository
{
    /**
     * @var \App\Models\Notice
     */
    protected $model;

    /**
     * Constructor.
     * @param \App\Models\Notice $notice
     */
    public function __construct(Notice $notice)
    {
        $this->model = $notice;
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
     * @return \App\Models\Notice
     */
    public function model(): Notice
    {
        return $this->model;
    }    
}