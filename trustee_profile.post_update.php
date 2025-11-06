<?php

/**
 * @file
 * trustee_profile.install
 */

/**
 * Implements hook_removed_post_updates().
 */
function trustee_profile_removed_post_updates() {
  return [
    'trustee_profile_post_update_8202' => '6.0.0',
    'trustee_profile_post_update_update_field_defs' => '6.0.0',
    'trustee_profile_post_update_samlauth' => '6.0.0',
    'trustee_profile_post_update_site_orgs' => '6.0.0',
  ];
}

/**
 * Create new rabbit hole message block for subthemes.
 */
function trustee_profile_post_update_rabbit_hole_block() {
  $theme = \Drupal::config('system.theme')->get('default');
  if (in_array($theme, ['stanford_basic', 'minimally_branded_subtheme'])) {
    return;
  }
  \Drupal::entityTypeManager()->getStorage('block')->create([
    'id' => "{$theme}_rabbit_hole_message",
    'theme' => $theme,
    'region' => 'content',
    'weight' => -10,
    'plugin' => 'rabbit_hole_message',
    'settings' => [
      'id' => 'rabbit_hole_message',
      'label' => 'Rabbit Hole Message',
      'label_display' => 0,
      'provider' => 'stanford_profile_helper',
      'context_mapping' => ['node' => '@node.node_route_context:node'],
    ],
    'visibility' => [
      'user_role' => [
        'id' => 'user_role',
        'negate' => TRUE,
        'context_mapping' => ['user' => '@user.current_user_context:current_user'],
        'roles' => ['anonymous' => 'anonymous'],
      ],
    ],
  ])->save();
}
