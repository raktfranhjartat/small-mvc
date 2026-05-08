<?= component('sections/title', ['pageTitle' => $pageTitle]) ?>

<?=  component('ui/form', [
        'action' => '/import', 
        'ajax' => true,
        'id' => 'importForm',
        'fields' => [
            [
                'label' => 'Välj bank',
                'name' => 'importBank',
                'type' => 'select',
                'options' => [
                    ['value' => '', 'text' => 'Välj bank..'],
                    ['value' => 'lansforsakringar', 'text' => 'Länsförsäkringar']
                ],
                'required' => true
            ],
            [
                'label' => 'Välj fil att importera',
                'name' => 'importFile',
                'type' => 'file',
                'required' => true,
                'help' => 'Endast CSV-filer är tillåtna.'
            ]
        ],
        'buttonText' => 'Importera'
    ]); ?>