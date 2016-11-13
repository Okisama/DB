<?php

namespace Repositories;

class StudentsRepository implements RepositoryInterface
{
    private $connector;

    /**
     * StudentsRepository constructor.
     * Initialize the database connection with sql server via given credentials
     * @param $connector
     */
    public function __construct($connector)
    {
        $this->connector = $connector;
    }

    public function findAll($limit = 1000, $offset = 0)
    {
        $statement = $this->connector->getPdo()->prepare('SELECT * FROM students LIMIT :limit OFFSET :offset');
        $statement->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
        $statement->bindValue(':offset', (int) $offset, \PDO::PARAM_INT);
        $statement->execute();
        return $this->fetchStudentData($statement);
    }

    private function fetchStudentData($statement)
    {
        $results = [];
        while ($result = $statement->fetch()) {
            $results[] = [
                'id' => $result['id'],
                'firstName' => $result['first_name'],
                'lastName' => $result['last_name'],
                'email' => $result['email'],
            ];
        }

        return $results;
    }

    public function insert($studentData)
    {
        $statement = $this->connector->getPdo()->prepare('INSERT INTO students (FirstName, LastName, Email, Phone, id_Dep) 
          VALUES(:firstName, :lastName, :email, :phone, :id_dep)');
        $statement->bindValue(':firstName', $studentData->getFirstName());
        $statement->bindValue(':lastName', $studentData->getLastName());
        $statement->bindValue(':email', $studentData->getEmail());
        $statement->bindValue(':phone', $studentData->getPhone());
        $statement->bindValue(':id_dep', $studentData->getIdDep());

        return $statement->execute();
    }

    public function find($id)
    {
        $statement = $this->connector->getPdo()->prepare('SELECT * FROM students WHERE id_Stud = :id LIMIT 1');
        $statement->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $statement->execute();
        $studentsData = $this->fetchStudentData($statement);

        return $studentsData[0];

    }

    public function update(array $studentData)
    {
        $statement = $this->connector->getPdo()->prepare("
        UPDATE students 
        SET FirstName = :firstName, 
        LastName = :lastName, 
        Email = :email,
        Phone = :phone,
        id_Dep = :id_dep
        WHERE id_Stud= :id");

        $statement->bindValue(':firstName', $studentData->getFirstName(), \PDO::PARAM_STR);
        $statement->bindValue(':lastName', $studentData->getLastName(), \PDO::PARAM_STR);
        $statement->bindValue(':email', $studentData->getEmail(), \PDO::PARAM_STR);
        $statement->bindValue(':phone', $studentData->getPhone(), \PDO::PARAM_STR);
        $statement->bindValue(':id_dep', $studentData->getIdDep(), \PDO::PARAM_INT);
        $statement->bindValue(':id', $studentData->getIdStud(), \PDO::PARAM_INT);

        return $statement->execute();
    }

    public function remove(array $studentData)
    {
        $statement = $this->connector->getPdo()->prepare("DELETE FROM students WHERE id = :id");

        $statement->bindValue(':id', $studentData['id'], \PDO::PARAM_INT);

        return $statement->execute();
    }


    /**
     * Search all entity data in the DB like $criteria rules
     * @param array $criteria
     * @return mixed
     */
    public function findBy($criteria = [])
    {
        // TODO: Implement findBy() method.
    }
}