<?php

use Kirby\Cms\App as Kirby;

load([
  'TagPage' => 'models/TagPage.php',
  'TagsetPage' => 'models/TagsetPage.php',
], __DIR__);

Kirby::plugin("auaust/tags", [
  'fields' => [
    // Tag's tagsets field.
    'tagsets' => [
      'extends' => 'pages',
      'props' => [
        'value' => function () {
          // Pretty hacky way to generate the list of tagset pages to be displayed in the field.
          // It works by generating a YAML string of the tagset pages' UUIDs.
          return
            $this->toPages(
              '- ' .
                implode(
                  PHP_EOL . '- ',
                  $this->model()->tagsets()->pluck('uuid')
                )
            );
        },
      ],
    ]
  ],
  'pageModels' => [
    'tag' => 'TagPage',
    'tagset' => 'TagSetPage',
  ],
  'blueprints' => [
    'pages/tag' =>     require_once __DIR__ . '/blueprints/pages/tag.php',
    'pages/tagset' =>  require_once __DIR__ . '/blueprints/pages/tagset.php',
    // Both tags and tagsets use the same blueprint as they're both only a way to access the tags.
    'pages/tags' =>    $tagsBlueprint = require_once __DIR__ . '/blueprints/pages/tags.php',
    'pages/tagsets' => $tagsBlueprint,
  ],
  'options' => [
    // A page which children are used to store the tags.
    'tagsPage' => page('tags'),
    // A page which children are used to store the tag sets.
    'tagsetsPage' => page('tagsets'),
  ],
]);
