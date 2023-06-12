<?php

return function ($kirby) {
  return [
    'title' => [
      'fr' => 'Groupe de tags',
      'en' => 'Tag set'
    ],
    'icon' => 'tag',
    'columns' => [
      [
        'width' => '1/2',
        'sections' => [
          'tags' => [
            'type' => 'fields',
            'fields' => [
              'tags' => [
                'type' => 'pages',
                'query' => 'site.find("' . $kirby->option('auaust.tags.tagsPage')->slug() . '").children',
                'translate' => false,
                'help' => [
                  'fr' => '' .
                    'Tous les tags pouvant être associés à la catégorie actuelle.' . PHP_EOL .
                    '**NB**: Les catégories de tags ne sont pas traduites. Assurez-vous d\'être dans la traduction anglaise pour modifier cette sélection.',
                  'en' => '' .
                    'All tags that can be associated with the current category.' . PHP_EOL .
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
