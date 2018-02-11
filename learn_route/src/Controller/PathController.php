<?php

namespace Drupal\learn_route\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class PathController extends ControllerBase
{

    /**
     * {@inheritdoc}
     */
    public function content($param)
    {
        $i = 'Lisa';
        $build = [
            '#markup' => $param,
        ];
        return $build;
    }
}