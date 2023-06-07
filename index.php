<?php

use Kirby\Cms\App as Kirby;

Kirby::plugin("auaust/tags", [
  'fields' => [
    // A selector field for tags
    'tags' => [
      'props' => [
        'tagset' => function (string $set = null) {
          // // Tags are stored in a content object.
          // // This by default is the site object, but it's recommended to use a parent page, i.e. a page named "tags".
          // if (($parent = option('auaust.tags.storage.parent')) === null) {
          //   throw new Exception('No parent set for tags field.');
          // };

          // $default = option('auaust.tags.default');
          // $key = option('auaust.tags.prefix') . ($set ?? $default);

          // $isDefault = $set === null || $set === $default;


          // if ($parent->content()->get($key) === null) {
          // }

          return $set ?? option('auaust.tags.default');
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
    // A page which children are used to store the tag sets.
    'storagePage' => null,
    // The prefix for the tags field. Is used before the set name.
    'prefix' => 'tags_',
    // The default set's name. Is used when no set is given.
    'default' => 'default',
  ]
]);
