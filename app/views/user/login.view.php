<?php component('ui/form', [
  'action' => '/login',
  'ajax' => true,
  'id' => 'loginForm',
  'fields' => [
    [
      'label' => 'E-post',
      'name' => 'email',
      'type' => 'email',
      'required' => true
    ],
    [
      'label' => 'Lösenord',
      'name' => 'password',
      'type' => 'password',
      'required' => true
    ]
  ],
  'buttonText' => 'Logga in'
]);

?>
