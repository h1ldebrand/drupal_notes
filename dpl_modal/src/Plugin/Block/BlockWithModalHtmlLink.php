<?php

/**
 * @file
 * Contains \Drupal\dpl_modal\Plugin\Block\BlockWithModalHtmlLink.
 */

namespace Drupal\dpl_modal\Plugin\Block;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * @Block(
 *     id = "block_with_modal_link",
 *     admin_label = @Translation("Modal API example: HTML link"),
 * )
 */

class BlockWithModalHtmlLink extends BlockBase{

    /**
     * @return array
     */
    public function defaultConfiguration(){
        return [
            'nid' => 1,
        ];
    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     * @return array
     */
    public function blockForm($form, FormStateInterface $form_state){
       $form = parent::blockForm($form, $form_state);
       $config = $this->getConfiguration();

       $form['nid'] = [
           '#type' => 'textfield',
           '#title' => 'NID to display in modal',
           '#default_value' => $config['nid'],
       ];

       return $form;

    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     */
    public function blockSubmit($form, FormStateInterface $form_state){
        $this->configuration['nid'] = $form_state->getValue('nid');
    }

    /**
     * Builds and returns the renderable array for this block plugin.
     *
     * If a block should not be rendered because it has no content, then this
     * method must also ensure to return no content: it must then only return an
     * empty array, or an empty array with #cache set (with cacheability metadata
     * indicating the circumstances for it being empty).
     *
     * @return array
     *   A renderable array representing the content of the block.
     *
     * @see \Drupal\block\BlockViewBuilder
     */
    public function build(){
        $config = $this->getConfiguration();
        return [
            '#type' => 'link',
            '#title' => new FormattableMarkup('Open node @nid in modal', ['@nid' => $config['nid']]),
            '#url' => Url::fromRoute('entity.node.canonical', ['node' => $config['nid']]),
            '#options' => [
                'attributes'=> [
                    'class' => ['use-ajax'],
                    'data-dialog-type' => 'modal',
                    'data-dialog-options' =>Json::encode([
                        'width' => 700,
                    ]),
                ],
            ],
            '#attached' => ['library' => ['core/drupal.dialog.ajax']],
        ];

    }
}