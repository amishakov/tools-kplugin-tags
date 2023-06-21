<?php

return function () {
  return [
    'title' => [
      'fr' => 'Tag',
      'en' => 'Tag'
    ],
    'create' => [
      'status' => 'unlisted',
      'redirect' => true,
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
                'type' => 'tagsets',
                'label' => [
                  'fr' => 'Groupes de tags',
                  'en' => 'Tag sets'
                ],
                'icon' => 'tag',
                'empty' => [
                  'fr' => 'Pas encore de groupe de tags sélectionné',
                  'en' => 'No tags group selected yet'
                ],
                'query' => 'site.find("' . option('auaust.tags.tagsetsPage')->id() . '").children',
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
      ],
      [
        'width' => '1/3',
        'sections' => [
          'meta' => [
            'type' => 'fields',
            'fields' => [
              'cover' => [
                'type' => 'files',
                'multiple' => false,
                'query' => 'page.images',
                'uploads' => [
                  'template' => 'tag-cover'
                ],
                'layout' => 'cardlets',
                'size' => 'small',
                'translate' => false,
              ]
            ]
          ],
          'files' => [
            'type' => 'files',
            'headline' => [
              'fr' => 'Fichiers uploadés',
              'en' => 'Uploaded files'
            ],
          ]
        ]
      ]
    ]
  ];
};
