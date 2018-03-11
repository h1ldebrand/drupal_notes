<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block"),
 *   category = @Translation("Hello World"),
 * )
 */
class HelloBlock extends BlockBase implements BlockPluginInterface{

    /**
     * {@inheritdoc}
     */
    public function build() {
        $config = $this->getConfiguration();

        if (!empty($config['hello_block_name'])) {
            $name = $config['hello_block_name'];
        }
        else {
            $name = $this->t('to no one');
        }

        $html = '<div>
                    <p>Здесь какойто параграф</p>
                    <p>Здесь второй параграф</p>
                </div>
                <a href="javascript:void(0)">link</a>';


        return array(
            '#markup' => $this->t('<div>
                    <p>@name</p>
                    <p>Здесь второй параграф</p>
                </div>
                <a href="javascript:void(0)">link</a>', array(
                '@name' => $name,
            )),
        );
    }

//    public function build() {
//        return array(
//            '#markup' => $this->t('Hello, World!'),
//        );
//    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $form = parent::blockForm($form, $form_state);

        $config = $this->getConfiguration();

        $form['hello_block_name'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Who'),
            '#description' => $this->t('Who do you want to say hello to?'),
            '#default_value' => isset($config['hello_block_name']) ? $config['hello_block_name'] : '',
        );

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        parent::blockSubmit($form, $form_state);
        $values = $form_state->getValue('hello_block_name');
        $this->configuration['hello_block_name'] = $values;
    }

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        $default_config = \Drupal::config('hello_world.settings');
        return [
            'hello_block_name' => $default_config->get('hello.name'),
        ];
    }

}