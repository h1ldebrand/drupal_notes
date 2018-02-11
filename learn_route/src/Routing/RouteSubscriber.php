<?php

namespace Drupal\learn_route\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

    /**
     * {@inheritdoc}
     */
    protected function alterRoutes(RouteCollection $collection) {
        // Change path '/user/login' to '/login'.
//        if ($route = $collection->get('<front>')) {
//            $route->setPath('/example');
//        }
//
//        // Always deny access to '/user/logout'.
//        // Note that the second parameter of setRequirement() is a string.
//        if ($route = $collection->get('<front>')) {
//            $route->setRequirement('_access', 'true');
//        }
    }

}