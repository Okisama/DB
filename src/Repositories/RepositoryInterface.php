<?php

namespace Repositories;


/**
 * @todo use your entities instead of arrays in your hometask
 *
 * Interface RepositoryInterface
 * @package Repositories
 */
interface RepositoryInterface
{
    /**
     * Insert new entity data to the DB
     * @param \class  $entityData
     * @return mixed
     */
    public function insert($entityData);

    /**
     * Update exist entity data in the DB
     * @param class $entityData
     * @return mixed
     */
    public function update($entityData);

    /**
     * Delete entity data from the DB
     * @param class $entityData
     * @return mixed
     */
    public function remove($entityData);
    /**
     * Search entity data in the DB by Id
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Search all entity data in the DB
     * @param string $limit
     * @param string $offset
     * @return array
     */
    public function findAll($limit, $offset);

    /**
     * Search all entity data in the DB like $criteria rules
     * @param array $criteria
     * @return mixed
     */
    public function findBy($criteria = []);
}