<?php

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
              'query' => 'site.find("tags").children'
            ]
          ]
        ]
      ]
    ]
  ]
];
