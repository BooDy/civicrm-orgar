<?php

return array(
  'relationship_types' => array(
    'group_name' => 'Organization Activity Record Preferences',
    'group' => 'orgar',
    'name' => 'relationship_types',
    'type' => 'Array',
    'default' => array(),
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 1,
    'description' => 'Which relationships should be displayed in the Activity records',
    'help_text' => 'In case a contact with this relationship has an activity related to this organization',
  ),
  'activity_types' => array(
    'group_name' => 'Organization Activity Record Preferences',
    'group' => 'orgar',
    'name' => 'activity_types',
    'type' => 'Array',
    'default' => 0,
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Which activity types should be displayed in the Activity records',
    'help_text' => 'Should an activity of this type & related to this organization be performed it shall be displayed in the activity records',
  ),
 );

?>
