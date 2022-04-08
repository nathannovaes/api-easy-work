<?php

namespace App\Repositories;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ModelNotExistOnDatabaseException;

/**
 * @codeCoverageIgnore
 */
abstract class BaseRepository implements RepositoryContract
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Primary key
     *
     * @return string
     */
    public abstract function primaryKey(): string;

    /**
     * Specify Table name
     *
     * @return string
     */
    public abstract function tableName(): string;

    /**
     * Specify Model
     *
     */
    public abstract function model();

    /**
     * Get all registers.
     *
     * @return \Illuminate\Support\Collection<Model>
     */
    public function getAll(): Collection
    {
        return $this->model()::all();
    }

    /**
     * Get all registers order by the column name.
     *
     * @param string $columnName
     * @return \Illuminate\Support\Collection<Model>
     */
    public function getAllOrderBy(string $columnName): Collection
    {
        return $this->model()::orderBy($columnName)->get();
    }

    /**
     * Find register by id.
     *
     * @param int $modelId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById(int $modelId): Model
    {
        return $this->model()->where($this->primaryKey(), '=', $modelId)->first();
    }

    /**
     * Find first register by foreign key id.
     *
     * @param string $foreignKeyColumnName
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findFirstByForeignKeyModelId($modelId, string $foreignKeyColumnName): Model
    {
        return $this->model()->where($foreignKeyColumnName, '=', $modelId)->first();
    }

    /**
     * Find all register by foreign key id.
     *
     * @param int $modelId
     * @param string $foreignKeyColumnName
     * @return \Illuminate\Support\Collection<Model>
     */
    public function findAllByForeignKeyModelId(int $modelId, string $foreignKeyColumnName): Collection
    {
        return $this->model()->where($foreignKeyColumnName, '=', $modelId)->get();
    }

    /**
     * Create a new register on database and return id.
     *
     * @param array<string> $data
     * @return int
     */
    public function create(array $data): int
    {   
        $timestamps = [
            'created_at' => now(),
            'updated_at' => now()
        ];

        foreach ($timestamps as $key => $value) {
            $data = Arr::add($data, $key, $value);
        }

        return DB::table($this->tableName())->insertGetId($data); 

    }

    /**
     * Update register on database.
     * 
     * @param int $modelId
     * @param array<string> $data
     * @param string $idColumnName
     * @return void
     */
    public function update(int $modelId, array $data, string $idColumnName): void
    {
        $data = Arr::add($data, 'updated_at', now());

        DB::table($this->tableName())
            ->where($idColumnName, $modelId)
            ->update($data); 
    }

    /**
     * Delete register.
     * 
     * @param int $modelId
     * @param string $idColumnName
     * @return void
     */
    public function delete(int $modelId, string $idColumnName): void
    {
        $deleted = DB::table($this->tableName())
            ->where($idColumnName, $modelId)
            ->delete();

        if (!$deleted) {
            throw new ModelNotExistOnDatabaseException("Model doesn't exists on the database.", 404);
        }
    }

    /**
     * Prepare query and find all.
     * @param array
     * @return Illuminate\Support\Collection<array>
     */
    public function search(array $data): Collection
    {
        $preparedQuery = [];
        $count = 0;
        foreach ($data as $key => $value) {
            $preparedQuery = Arr::add($preparedQuery, $count, [$key, 'like', $value]);
            $count++; 
        }

        $searchResults = DB::table($this->tableName())->where($preparedQuery)->get();

        $transformedArrayToModel = collect();
        foreach ($searchResults as $searchResult) {

            $transformedArray = $this->model::hydrate(array($searchResult));

            foreach ($transformedArray as $model) {
                $transformedArrayToModel->push($model);
            }
        }

        return $transformedArrayToModel;
    }
}