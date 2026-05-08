<div class="row">
    <div class="col-8">
        <?php 

        component('ui/form', [
          'action' => '/registrera',
          'ajax' => false,
          'id' => 'registreraForm',
          'fields' => [
            [
              'label' => 'Namn',
              'name' => 'name',
              'type' => 'text',
              'required' => true
            ],
            [
              'label' => 'E-post',
              'name' => 'email',
              'type' => 'email',
              'required' => true
            ],
            [
              'label' => 'Lösenord',
              'name' => 'rePassword',
              'type' => 'password',
              'required' => true
            ],
            [
              'label' => 'Lösenord igen',
              'name' => 'password',
              'type' => 'password',
              'required' => true
            ],
            [
              'label' => 'Jag godkänner <a href="/gdpr">integritetspolicyn (GDPR)</a>',
              'name' => 'gdpr',
              'type' => 'checkbox',
              'required' => true
            ]
          ],
          'buttonText' => 'Registrera'
        ]);
        
        ?>
    </div>
</div>