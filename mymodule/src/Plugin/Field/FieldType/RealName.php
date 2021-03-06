<?php

/**
 * @file
 * Contains \Drupal\mymodule\Plugin\Field\FieldType\RealName.
 */

namespace Drupal\mymodule\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 *Plugin implementation of the 'realname' Field type.
 *
 * @FieldType(
 *  id = "realname",
 *  label = @Translation("Real name"),
 *  description = @Translation("This field stores a first and last name."),
 *  category = @Translation("Custom"),
 *  default_widget = "realname_default",
 *  default_formatter = "realname_one_line"
 * )
 */

class RealName extends FieldItemBase{
    /**
     * {@inheritdoc}
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition)
    {
        return [
            'columns' => array(
                'first_name' => array(
                    'description' => 'First name.',
                    'type' => 'varchar',
                    'length' => '255',
                    'not null' => 'TRUE',
                    'default' => ''
                ),
                'last_name' => array(
                    'description' => 'Last name.',
                    'type' => 'varchar',
                    'length' => '255',
                    'not null' => 'TRUE',
                    'default' => ''
                )
            ),
            'indexes' => array(
                'first_name' => array('first_name'),
                'last_name' => array('last_name'),
            ),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition)
    {
        $properties['first_name'] = DataDefinition::create('string')
            ->setLabel(t('First name'));
        $properties['last_name'] = DataDefinition::create('string')
            ->setLabel(t('Last name'));

        return $properties;
    }

}