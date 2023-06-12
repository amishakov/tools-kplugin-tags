<?php

use Kirby\Cms\App as Kirby;
use Kirby\Cms\Page;

load([
  'TagPage' => 'models/TagPage.php',
  'TagSetPage' => 'models/TagSetPage.php',
], __DIR__);

Kirby::plugin("auaust/tags", [
  'pageModels' => [
    'tag' => 'TagPage',
    'tagset' => 'TagSetPage',
  ],
  'options' => [
    // A page which children are used to store the tags.
    'tagsPage' => page('tags'),
    // A page which children are used to store the tag sets.
    'tagSetsPage' => page('tagsets'),
    // The prefix for the tags field. Is used before the set name.
    'prefix' => 'tags_',
    // The default set's name. Is used when no set is given.
    'default' => 'default',
  ],
  'blueprints' => [
    'pages/tag' => [
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
    ]
  ]
]);
