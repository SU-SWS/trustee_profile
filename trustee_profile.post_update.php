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
    'trustee_profile_post_update_rabbit_hole_block' => '7.0.0',
  ];
}
