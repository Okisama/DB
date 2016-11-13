<?php

namespace Repositories;


class DepartmentEntity
{

    public $depname;

    /**
     * @param mixed $depname
     */
    public function setDepname($depname)
    {
        $this->depname = $depname;
    }

    /**
     * @return mixed
     */
    public function getDepname()
    {
        return $this->depname;
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

    public $universityName;

    /**
     * @param mixed $universityName
     */
    public function setUniversityName($universityName)
    {
        $this->universityName = $universityName;
    }

    /**
     * @return mixed
     */
    public function getUniversityName()
    {
        return $this->universityName;
    }


}