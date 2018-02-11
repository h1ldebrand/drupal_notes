<?php
/**
 * @file
 * Contains \Drupal\mymodule\Plugin\Block
 */

namespace Drupal\mymodule\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * @Block(
 *     id = "copyright_block",
 *     admin_label = @Translation("Copyright"),
 *     category = @Translation("Custom")
 * )
 *
 */

class Copyright extends BlockBase{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $date = new \DateTime();
        return [
            '#markup' => t('Copyright @year&copy; My company', [
                '@year' => $date->format('Y')
            ])
        ];
    }
}