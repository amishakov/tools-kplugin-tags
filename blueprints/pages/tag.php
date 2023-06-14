<?php

return function () {
  return [
    'title' => [
      'fr' => 'Tag',
      'en' => 'Tag'
    ],
    'icon' => 'tag',
    'columns' => [
      [
        'width' => '2/3',
        'sections' => [
          'infos' => [
            'type' => 'fields',
            'fields' => [
              'description' => [
                'type' => 'textarea',
                'label' => [
                  'fr' => 'Description',
                  'en' => 'Description'
                ],
                'buttons' => [
                  'bold',
                  'italic',
                  '|',
                  'link',
                  '|',
                ],
                'size' => 'medium'
              ],
              '_tagsets' => [
                'type' => 'tags-tagsets',
                'label' => [
                  'fr' => 'Groupes de tags',
                  'en' => 'Tag sets'
                ],
                'translate' => false,
                'help' => [
                  'fr' => '' .
                    'Tous les groupes de tags auxquel ce tag peut être associé.' . PHP_EOL .
                    '**NB**: Les catégories de tags ne sont pas traduites. Assurez-vous d\'être dans la traduction anglaise pour modifier cette sélection.',
                  'en' => '' .
                    'All tag sets that this tag can be associated with.' . PHP_EOL .
                    '**NB**: Tag categories are not translated. Make sure you are in the English translation to edit this selection.'
                ]
              ]
            ]
          ]
        ]
      ]
    ]
  ];
};
