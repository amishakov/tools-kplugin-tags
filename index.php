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
  'hooks' => [
    'page.update:after' => function (Page $newPage, Page $oldPage) {

      $debugFile = kirby()->root('site') . '/debug.txt';
      file_put_contents($debugFile, 'tags page update: ' . $newPage->intendedTemplate() . PHP_EOL, FILE_APPEND);

      // If the tag is a tag page and the update is on the tagsets field,
      // we update the tagsets to reflect the change in their tags field.
      if ($newPage->intendedTemplate()->name() === 'tag') {

        $oldTagsets = $oldPage->tagsets()->toPages();
        $newTagsets = $newPage->tagsets()->toPages();

        file_put_contents($debugFile, 'old tagsets: ' . $oldTagsets->toString() . PHP_EOL, FILE_APPEND);
        file_put_contents($debugFile, 'new tagsets: ' . $newTagsets->toString() . PHP_EOL, FILE_APPEND);

        $removedTagsets = [];
        foreach ($oldTagsets->toArray() as $tagset) {
          if (!$newTagsets->has($tagset)) {
            $removedTagsets[] = $tagset;
          }
        }

        $addedTagsets = [];
        foreach ($newTagsets->toArray() as $tagset) {
          if (!$oldTagsets->has($tagset)) {
            $addedTagsets[] = $tagset;
          }
        }

        foreach ($removedTagsets as $tagset) {
          $tagset->update([
            'tags' => $tagset->tags()->toPages()->not($newPage)->pluck('id'),
          ]);
        }
        foreach ($addedTagsets as $tagset) {
          $tagset->update([
            'tags' => $tagset->tags()->toPages()->add($newPage)->pluck('id'),
          ]);
        }
      }
    }
  ]
]);
