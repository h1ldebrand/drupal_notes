<?php

/**
 * @file
 * Contains \Drupal\ajaxdummy\Form\AjaxFormSubmitExample.
 */

namespace Drupal\ajaxdummy\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form with modal window
 */

class AjaxFormSubmitExample extends FormBase{

    /**
     * Returns a unique string identifying the form.
     *
     * @return string
     *   The unique string identifying the form.
     */
    public function getFormId()
    {
       return "ajax_form_submit_example";
    }

    /**
     * Form constructor.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     *
     * @return array
     *   The form structure.
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['email'] = [
            '#title' => 'Email',
            '#type' => 'email',
            '#required' => TRUE,
            '#ajax' => [
                # Если валидация находится в другом классе, то необходимо указывать
                # в формате Drupal\modulename\ClassName::methodName.
                'callback' => '::validateEmailAjax',
                # Событие, на которое будет срабатывать наш AJAX.
                'event' => 'change',
                # Настройки прогресса. Будет показана гифка с анимацией загрузки.
                'progress' => [
                    'type' => 'throbber',
                    'message' => t('Verifying email...'),
                ]
            ],
            # Элемент, в который мы будем писать результат в случае необходимости.
            '#suffix' => '<div class="email-validation-message"></div>'
        ];

        $form['select'] = [
          '#title' => 'Select some fruit',
            '#type' => 'select',
            '#options' => [
                'apple' => 'Apple',
                'banana' => 'Banana',
                'orange' => 'Orange'
            ],
            '#empty_option' => '- Select -',
            "#required" => TRUE,
            '#ajax' => [
                'callback' => '::validateFruitAjax',
                'event' => 'change'
            ],
            '#prefix' => '<div id="fruit-selector">',
            '#suffix' => '</div>',
        ];

        # Добавляем в форму новый элемент где будем выводить системные сообщения.
        $form['system_messages'] = [
            '#markup' => '<div id="form-system-messages"></div>',
            '#weight' => -100,
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#name' => 'submit',
            '#value' => 'Submit this form',
            '#ajax' => [
                'callback' => '::ajaxSubmitCallback',
                'event' => 'click',
                'progress' => [
                    'type' => 'throbber',
                ],
            ],
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateEmailAjax(array &$form, FormStateInterface $form_state){
        $response = new AjaxResponse();
        if(substr($form_state->getValue('email'), -11) == 'example.com'){
            $response->addCommand(new HtmlCommand('.email-validation-message', 'This provider can lost our mail. Be care!'));
        }
        else{
            # Убираем ошибку если она была и пользователь изменил почтовый адрес.
            $response->addCommand(new HtmlCommand('.email-validation-message', ''));
        }
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function validateFruitAjax(array &$form, FormStateInterface $form_state){
        $response = new AjaxResponse();
        switch($form_state->getValue('select')){
            case 'apple' : $style = ['border' => '2px solid green'];break;
            case 'banana' : $style = ['border' => '2px solid yellow'];break;
            case 'orange' : $style = ['border' => '2px solid orange'];break;
            default: $style = ['border' => '2px solid transparent'];break;
        }
        $response->addCommand(new CssCommand('#fruit-selector select', $style));
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function ajaxSubmitCallback(array &$form, FormStateInterface $form_state) {
        $ajax_response = new AjaxResponse();
        $message = [
            '#theme' => 'status_messages',
            '#message_list' => drupal_get_messages(),
            '#status_headings' => [
                'status' => t('Status message'),
                'error' => t('Error message'),
                'warning' => t('Warning message'),
            ],
        ];
        $messages = \Drupal::service('renderer')->render($message);
        $ajax_response->addCommand(new HtmlCommand('#form-system-messages', $messages));
        return $ajax_response;
    }

    /**
     * Form submission handler.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        drupal_set_message('Form submitted! Hooray!');
    }
}