<?php

namespace Repositories;

class DepartmentsRepository implements RepositoryInterface
{
    private $connector;


    public function __construct($connector)
    {
        $this->connector = $connector;
    }

    public function findAll($limit = 100, $offset = 0)
    {
        $statement = $this->connector->getPdo()->prepare('
            SELECT * FROM department
            JOIN university ON department.UniversityName = university.id_Name
            LIMIT :limit OFFSET :offset
        ');
        $statement->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
        $statement->bindValue(':offset', (int) $offset, \PDO::PARAM_INT);
        $statement->execute();
        return $this->fetchResultsData($statement);
    }

    private function fetchResultsData($statement)
    {
        $results = [];
        while ($result = $statement->fetch()) {
            $results[] = [
                'id' => $result['id'],
                'depname' => $result['department_name'],
                'universityName' => $result['university_name'],
            ];
        }

        return $results;
    }


    public function insert($departmentData)
    {
        $statement = $this->connector->getPdo()->prepare('INSERT INTO department (DepName, UniversityName) 
          VALUES(:depName, :universityName)');
        $statement->bindValue(':depName', $departmentData->getDepName());
        $statement->bindValue(':universityName', $departmentData->getUniversityName());


        return $statement->execute();
    }

    public function update($departmentData)
    {
        $statement = $this->connector->getPdo()->prepare("
        UPDATE department 
        SET DepName = :depName, 
        UniversityName = :universityName
        WHERE id_Dep= :id");

        $statement->bindValue(':depName', $departmentData->getDepName(), \PDO::PARAM_STR);
        $statement->bindValue(':universityName', $departmentData->getUniversityName(), \PDO::PARAM_STR);
        $statement->bindValue(':id', $departmentData->getIdDep(), \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function remove($departmentData)
    {
        $statement = $this->connector->getPdo()->prepare("DELETE FROM department WHERE id_dep = :id");

        $statement->bindValue(':id', $departmentData->getIdDep(), \PDO::PARAM_INT);

        return $statement->execute();
    }


    public function find($id)
    {
        $statement = $this->connector->getPdo()->prepare('SELECT * FROM department WHERE id_Dep = :id LIMIT 1');
        $statement->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $statement->execute();
        $departmentData = $this->fetchStudentData($statement);

        return $departmentData[0];

    }


    public function findBy($criteria = [])
    {
        // TODO: Implement findBy() method.
    }
}