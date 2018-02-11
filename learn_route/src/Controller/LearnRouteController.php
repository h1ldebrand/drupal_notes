<?php
/**
 * Created by PhpStorm.
 * User: h1ldebrand
 * Date: 04.02.2018
 * Time: 18:27
 */

namespace Drupal\learn_route\Controller;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;


use Drupal\Core\Controller\ControllerBase;

class LearnRouteController extends ControllerBase
{
    public function changeFrontUrl(){
        $url = Url::fromRoute('<front>', [], ['impl']);
        return new RedirectResponse($url->toString());

    }
}