<?php

/**
 * Implements template_preprocess_HOOK().
 * Обработчик переменных для первого примера.
 */
function template_preprocess_dummy_example_first(&$variables) {
    $date_formatter = \Drupal::service('date.formatter');
    $variables['date'] = $date_formatter->format(time());
}


/**
 * Implements template_preprocess_HOOK().
 */
function template_preprocess_dummy_example_second(&$variables) {
    // Для удобства записываю значение переменной list_type в локальную переменную
    // в виде ссылки.
    $list_type = &$variables['list_type'];
    // Задаем список допустимых типов.
    $allowed_list_types = ['ol', 'ul'];
    // Если передано значение не из массива выше, мы устанавливаем значение по
    // умолчанию.
    if (!in_array($list_type, $allowed_list_types)) {
        $list_type = 'ul';
    }
}