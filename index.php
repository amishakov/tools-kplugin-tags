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
      'save' => function ($tagsetsAfter) {


        $debugFile = kirby()->root('site') . '/debug.txt';

        file_put_contents(
          $debugFile,
          print_r(
            [
              array_map(
                function ($tagset) {
                  return $tagset['uuid'];
                },
                $tagsetsAfter
              ),
              array_map(
                function ($uuid) {
                  return $uuid->toString();
                },
                $this->model()->tagsets()->pluck('uuid')
              ),
            ],
            true
          ) . "\n\n----\n\n",
        );

        // page($tagsetsAfter[0]['uuid'])

        // file_put_contents(
        //   $debugFile,
        //   print_r(
        //     page($tagsetsAfter[0]['uuid']),
        //     true
        //   ) . "\n\n----\n\n",
        //   FILE_APPEND
        // );

        return array_map(function ($tagset) {
          return $tagset['uuid'];
        }, $tagsetsAfter);

        // $tagsetsAfter is an array of page objects

        // The model ($this->model()) is the current page(tag) which tagsets field is being saved

        // Creates an array of the UUIDs of the tagsets before the save
        return [
          'before' => $tagsetsBefore = array_map(
            function ($tagset) {
              return $tagset->toString();
            },
            $this->model()->tagsets()->pluck('uuid')
          ),
          'after' => $tagsetsAfter
        ];

        // Creates an array of the UUIDs of the new tagsets to be saved
        $tagsetsAfter = array_map(
          function ($tagset) {
            return $tagset['uuid'];
          },
          $tagsetsAfter
        );

        // The UUID of the current tag, the one to add or remove from the tagsets
        $tagUuid = $this->model()->uuid()->toString();

        // The tagsets to which the tag must be added
        $mustAdd = array_filter(
          $tagsetsAfter,
          function ($tagset) use ($tagsetsBefore, $tagUuid) {
            return !in_array($tagset, $tagsetsBefore) && page($tagset)->tags()->toPages()->has($tagUuid);
          }
        );

        // The tagsets from which the tag must be removed
        $mustRemove = array_filter(
          $tagsetsBefore,
          function ($tagset) use ($tagsetsAfter, $tagUuid) {
            return !in_array($tagset, $tagsetsAfter) && !page($tagset)->tags()->toPages()->has($tagUuid);
          }
        );

        return [
          'before' => $tagsetsBefore,
          'after' => $tagsetsAfter,
          'add' => $mustAdd,
          'remove' => $mustRemove,
        ];

        // Update the tagsets
        foreach ($mustAdd as $tagsetUuid) {
          $tagset = page($tagsetUuid);
          $tagset->update([
            'tags' => array_merge(
              $tagset->tags()->toPages()->pluck('uuid'),
              [$tagUuid]
            ),
          ]);
        }

        foreach ($mustRemove as $tagsetUuid) {
          $tagset = page($tagsetUuid);
          $tagset->update([
            'tags' => array_diff(
              $tagset->tags()->toPages()->pluck('uuid'),
              [$tagUuid]
            ),
          ]);
        }

        // Return null so that the field is not saved.
        return null;
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
