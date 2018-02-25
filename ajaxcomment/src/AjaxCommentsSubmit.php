<?php

/**
 * @file
 * Contains \Drupal\ajaxcomment\AjaxCommentsSubmit.
 */

namespace Drupal\ajaxcomment;

use Drupal\Component\Utility\Html;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormStateInterface;

class AjaxCommentsSubmit{
    /**
     * Ajax form submit callback.
     *
     * @param array $form
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     * @return \Drupal\Core\Ajax\AjaxResponse
     */
    public function ajaxSubmitCallback(array &$form, FormStateInterface $form_state){
        $ajax_response = new AjaxResponse();

        $message = [
            '#theme' => 'status_message',
            '#message_list' => drupal_get_messages(),
            '#status_headings' => [
                'status' => t('Status message'),
                'error' => t('Error message'),
                'warning' => t('Warning message'),
            ],
        ];
        $form_state->cleanValues();
        $messages = \Drupal::service('renderer')->render($message);
        $ajax_response->addCommand(new HtmlCommand('#'. HTML::getClass($form['form_id']['#value']) . '-messages', $messages));
        $form_state->cleanValues();


        if ($form_state->hasAnyErrors()) {
        }
        else {
            $form_values = $form_state->getValues();
            $form_state->setValue('field_company_name', '');
        }

        return $ajax_response;
    }

}