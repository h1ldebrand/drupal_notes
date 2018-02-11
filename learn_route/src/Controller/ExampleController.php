<?php

namespace Drupal\learn_route\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * An example controller.
 */
class ExampleController extends ControllerBase {

    /**
     * {@inheritdoc}
     */
    public function content(){
        $url = Url::fromRoute('<front>', [], ['impl']);
        return new RedirectResponse($url->toString());

    }

}