<?php

namespace Drupal\dummy\Controller;

use Drupal\Core\Controller\ControllerBase;


class HookThemeExamples extends ControllerBase{
    /**
     * {@inheritdoc}
     */
    public function page() {
        return [
            '#theme' => 'dummy_example_first',
        ];
    }
}