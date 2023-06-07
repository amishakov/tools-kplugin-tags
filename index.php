<?php

use Kirby\Cms\App as Kirby;

Kirby::plugin("auaust/tags", [
  'fields' => [
    // A selector field for tags
    'tags' => [
      'props' => [
        'tagset' => function (string $set = null) {
          // Tags are stored in a content object.
          // This by default is the site object, but it's recommended to use a parent page, i.e. a page named "tags".
          if (($parent = option('auaust.tags.storage.parent')) === null) {
            throw new Exception('No parent set for tags field.');
          };

          $default = option('auaust.tags.default');
          $key = option('auaust.tags.prefix') . ($set ?? $default);

          $isDefault = $set === null || $set === $default;


          if ($parent->content()->get($key) === null) {
          }


          return;
        },
      ],
      'computed' => [
        'value' => function () {
          return $this->tagset;
        },
      ],
    ]
  ],
  'options' => [
    'storage' => [
      // In which content object should the tags be stored?
      'parent' => kirby()->site(),
    ],
    // The prefix for the tags field. Is used before the set name.
    'prefix' => 'tags_',
    // The name default set. Is used when no set is given.
    'default' => 'default',
  ]
]);
