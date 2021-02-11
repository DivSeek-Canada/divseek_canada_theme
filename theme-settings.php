<?php
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function divseekcanada_theme_form_system_theme_settings_alter(&$form, &$form_state) {

  // Remove settings which do not make sense.
  unset(
    $form['theme_settings']['toggle_node_user_picture'],
    $form['theme_settings']['toggle_comment_user_picture'],
    $form['theme_settings']['toggle_comment_user_verification'],
  );

  // Professional Theme Settings.
  $form['prof_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Professional Theme Settings'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  $form['prof_settings']['breadcrumbs'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show breadcrumbs in a page'),
    '#default_value' => theme_get_setting('breadcrumbs','lexus_zymphonies_theme'),
    '#description'   => t("Check this option to show breadcrumbs in page. Uncheck to hide."),
  );

}
