<?php

namespace Controllers;

use Repositories\DepartmentRepository;
use Repositories\DepartmentEntity;
use Views\Renderer;

class DepartmentsController
{
    private $repository;

    private $loader;

    private $twig;

    public function __construct($connector)
    {
        $this->repository = new DepartmentsRepository($connector);
        $this->loader = new \Twig_Loader_Filesystem('src/Views/templates/');
        $this->twig = new \Twig_Environment($this->loader, array(
            'cache' => false,
        ));
    }

    public function indexAction()
    {
        $departmentData = $this->repository->findAll();

        return $this->twig->render('departments.html.twig', ['departments' => $departmentData ]);
    }
    public function newAction()
    {
        if (isset($_POST['department_name'])) {
            $departmentData = new DepartmentEntity();
            $departmentData->setDepname($_POST['department_name']);
            $departmentData->setUniversityName($_POST['university_name']);
            $this->repository->insert($departmentData);
            return $this->indexAction();
        }
        return $this->twig->render('departments_form.html.twig',
            [
                'department_name' => '',
                'university_name' => '',

            ]
        );
    }

    public function editAction()
    {
        if (isset($_POST['department_name'])) {
            $departmentData = new DepartmentEntity();
            $departmentData->setDepname($_POST['department_name']);
            $departmentData->setUniversityName($_POST['university_name']);
            $departmentData->setIdDep((int) $_GET['id']);
            $this->repository->update($departmentData);
            return $this->indexAction();
        }
        $departmentData = $this->repository->find((int) $_GET['id']);
        return $this->twig->render('departments_form.html.twig',
            [
                'department_name' => $departmentData->getDepName(),
                'university_name' => $departmentData->getUniversiyuName(),
            ]
        );
    }

    public function deleteAction()
    {
        if (isset($_POST['id'])) {
            $id = (int) $_POST['id'];
            $this->repository->remove(['id' => $id]);
            return $this->indexAction();
        }
        return $this->twig->render('departments_delete.html.twig', array('department_id' => $_GET['id']));
    }
}