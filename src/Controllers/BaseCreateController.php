<?php
/**
 * Created by PhpStorm.
 * User: rokka
 * Date: 12.11.16
 * Time: 18:13
 */

namespace Controllers;

use Repositories\BaseCreateRepository;
use Views\Renderer;

class BaseCreateController
{
    private $repository;

    private $loader;

    private $twig;

    public function __construct($connector)
    {
        $this->repository = new BaseCreateRepository($connector);
        $this->loader = new \Twig_Loader_Filesystem('src/Views/templates/');
        $this->twig = new \Twig_Environment($this->loader, array(
            'cache' => false,
        ));
    }

    public function createAction()
    {
        $studentsData = $this->repository->init();

        return $this->twig->render('base_create.html.twig');
    }

}