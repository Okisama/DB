<?php
/**
 * Created by PhpStorm.
 * User: rokka
 * Date: 12.11.16
 * Time: 18:36
 */

namespace Repositories;


class StudentEntity
{
    public $firstName;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public $lastName;

    /**
     * @param mixed $lastname
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastNameame;
    }

    public $email;

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    public $phone;

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    public $id_stud;

    /**
     * @param mixed $id_stud
     */
    public function setIdStud($id_stud)
    {
        $this->id_stud = $id_stud;
    }

    /**
     * @return mixed
     */
    public function getIdStud()
    {
        return $this->id_stud;
    }

    public $id_dep;

    /**
     * @param mixed $id_dep
     */
    public function setIdDep($id_dep)
    {
        $this->id_dep = $id_dep;
    }

    /**
     * @return mixed
     */
    public function getIdDep()
    {
        return $this->id_dep;
    }


}