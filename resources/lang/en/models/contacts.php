<?php

return array (
  'singular' => 'Contact',
  'plural' => 'Contacts',
  'fields' => [
    'id' => 'Id',
    'name' => 'Name',
    'email' => 'Email',
    'type' => 'Type',
    'subject' => 'Subject',
    'message' => 'Message',
    'read_at' => 'Read At',
    'status' => 'Status',
    'reply_message' => 'Reply message',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
  ],
  'types' => [
    'contact' => 'Contact',
    'complaint' => 'Complaint',
    'suggestion' => 'Suggestion',
    'enquiry' => 'Enquiry',
    'help' => 'Help',
  ],
  'read' => 'Read',
  'unread' => 'Unread'
);
