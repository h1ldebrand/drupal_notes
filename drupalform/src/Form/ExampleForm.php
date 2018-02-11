<?php

/**
 * @file
 * Contains \Drupal\drupalform\Form\ExampleForm.
 */

namespace Drupal\drupalform\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ExampleForm extends ConfigFormBase {

    /**
     *{@inheritdoc}
     */

   protected function getEditableConfigNames()
   {
       return ['drupalform.company'];
   }


    /**
     *{@inheritdoc}
     */
    public function getFormId(){
        return 'drupalform_example_form';
    }


    /**
     *{@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state){

        $form['company_name'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Company name'),
            '#default_value' => $this->config('drupalform.company')->get('name')
        );

//        $form['phone'] = array(
//            '#type' => 'tel',
//            '#title' => $this->t('Phone'),
//        );
//
//        $form['email'] = array(
//            '#type' => 'email',
//            '#title' => $this->t('Email'),
//        );
//
//        $form['integer'] = array(
//            '#type' => 'number',
//            '#title' => $this->t('Some integer'),
//            '#step' => 1,
//            '#min' => 0,
//            '#max' => 100,
//        );
//
//        $form['date'] = array(
//            '#type' => 'date',
//            '#title' => $this->t('Date'),
//            '#date_date_format' => 'Y-m-d',
//        );
//
//        $form['website'] = array(
//            '#type' => 'url',
//            '#title' => $this->t('Website'),
//        );
//
//        $form['search'] = array(
//            '#type' => 'search',
//            '#title' => $this->t('Search'),
//            '#autocomplete_route_name' => FALSE
//        );

//        $form['submit'] = array(
//            '#type' => 'submit',
//            '#value' => $this->t('Save'),
//        );
        return parent::buildForm($form, $form_state);

    }

    public function validateForm(array &$form, FormStateInterface $form_state)
    {
//        parent::validateForm($form, $form_state); // TODO: Change the autogenerated stub
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        parent::submitForm($form, $form_state);
        $this->config('drupalform.company')->set('name', $form_state->getValue('company_name'));
    }

}