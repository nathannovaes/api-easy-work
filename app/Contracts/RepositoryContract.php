<?php

namespace App\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryContract
{
  /**
   * @return \Illuminate\Support\Collection<Model>
   */	
	public function getAll(): Collection;

  /**
   * @param array<string> $data
   * @return int
   */
  public function create(array $data): int;

  /**
   * @param int $modelId
   * @param array<string> $data
   * @param string $idColumnName
   * @return void
   */
  public function update(int $modelId, array $data, string $idColumnName): void;
  
  /**
   * @param int $modelId
   * @param string $idColumnName
   * @return void
   */
  public function delete( int $modelId, string $idColumnName): void;

}
