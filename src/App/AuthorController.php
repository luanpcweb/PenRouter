<?php

namespace Pen\App;

use Pen\Controller;

class AuthorController extends Controller
{
    private $model;

    public function __construct(AuthorModel $model)
    {
        $this->model = $model;
    }

    public function home($fragment)
    {
        return ['fragments' => $fragment];
    }

    public function action(AuthorRepository $repository, $id, $none)
    {
        return [
            'action' => [
                'parameters' => [$id, $none],
                'say' => $repository->say($this->model->say())
            ]
        ];
    }
}
