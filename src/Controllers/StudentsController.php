<?php

namespace Controllers;

use Repositories\StudentsRepository;
use Repositories\StudentEntity;
use Views\Renderer;


class StudentsController
{
    private $repository;

    private $loader;

    private $twig;

    public function __construct($connector)
    {
        $this->repository = new StudentsRepository($connector);
        $this->loader = new \Twig_Loader_Filesystem('src/Views/templates/');
        $this->twig = new \Twig_Environment($this->loader, array(
            'cache' => false,
        ));
    }

    public function indexAction()
    {
        $studentsData = $this->repository->findAll();

        return $this->twig->render('students.html.twig', ['students' => $studentsData]);
    }

    public function newAction()
    {
        if (isset($_POST['first_name'])) {
            $studentData = new StudentEntity();
            $studentData->setFirstName($_POST['first_name']);
            $studentData->setLastName($_POST['last_name']);
            $studentData->setEmail($_POST['email']);
            $studentData->setPhone($_POST['phone']);
            $studentData->setIdDep($_POST['id_dep']);
            $this->repository->insert($studentData);
            return $this->indexAction();
        }
        return $this->twig->render('students_form.html.twig',
            [
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'phone' => '',
                'id_dep' => '',
            ]
        );
    }

    public function editAction()
    {
        if (isset($_POST['first_name'])) {
            $studentData = new StudentEntity();
            $studentData->setFirstName($_POST['first_name']);
            $studentData->setLastName($_POST['last_name']);
            $studentData->setEmail($_POST['email']);
            $studentData->setPhone($_POST['phone']);
            $studentData->setIdDep($_POST['id_dep']);
            $studentData->setIdStud((int) $_GET['id']);
            $this->repository->update($studentData);
            return $this->indexAction();
        }
        $studentData = $this->repository->find((int) $_GET['id']);
        return $this->twig->render('students_form.html.twig',
            [
                'first_name' => $studentData['firstName'], //и сюда
                'last_name' => $studentData['lastName'],
                'email' => $studentData['email'],
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
        return $this->twig->render('students_delete.html.twig', array('student_id' => $_GET['id']));
    }
}