<?php

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
            'tagsets' => [
              'type' => 'pages',
              'query' => 'site.find("tagsets").children'
            ]
          ]
        ]
      ]
    ]
  ]
];
