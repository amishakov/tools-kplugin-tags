<?php

use Kirby\Cms\App as Kirby;

load([
  'TagPage' => 'models/TagPage.php',
  'TagSetPage' => 'models/TagSetPage.php',
], __DIR__);

Kirby::plugin("auaust/tags", [
  'fields' => [
    // Tag's tagsets field.
    'tags-tagsets' => [
      'extends' => 'pages',
      'save' => function ($value) {
        // // The tagsets page from the config.
        // $tagsetsPage = option('auaust.tags.tagsetsPage');

        // // $newTags is an array of `page://<uuid>` strings.
        // $tags = array_map(
        //   function ($tag) {
        //     return $tag['uuid'];
        //   },
        //   $value
        // );

        // foreach ($tagsetsPage->children() as $tagsetPage) {
        //   $oldTags = $tagsetPage->tags()->toPages()->pluck('uuid');

        //   // $newTags is $oldTags with

        // }

        // Return null so that the field is not saved.
        return dump($value, false);
      },
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
