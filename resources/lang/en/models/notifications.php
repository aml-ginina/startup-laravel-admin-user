<?php

return array (
  'singular' => 'Notification',
  'plural' => 'Notifications',
  'fields' => 
  array (
    'id' => 'Id',
    'title' => 'Title',
    'text' => 'Text',
    'url' => 'Url',
    'icon' => 'Icon',
    'type' => 'Type',
    'to' => 'To',
    'admin_id' => 'Admin Id',
    'user_id' => 'User Id',
    'read_at' => 'Read At',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
  ),
  'types' => [
    'primary' => 'Primary',
    'info' => 'Info',
    'success' => 'Success',
    'warning' => 'Warning',
    'danger' => 'Danger',
  ],
  'to' => [
    'admin' => 'Admin',
    'user' => 'User',
    'all_admins' => 'All Admins',
    'all_users' => 'All Users',
  ],
  'unauthorized' => 'Sorry, you are not authorized to access this notification.',
  'read' => 'Read',
  'unread' => 'Unread'
);
