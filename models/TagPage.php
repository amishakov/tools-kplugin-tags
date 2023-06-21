<?php

use Kirby\Cms\Page;

class TagPage extends Page
{
  public function tagsets()
  {
    $tag = $this;
    $tagsets = option('auaust.tags.tagsetsPage')
      ->children()
      ->filter(
        function ($tagset) use ($tag) {
          return $tagset->tags()->toPages()->has($tag);
        }
      );
    return $tagsets;
  }

  public function update(array $input = null, string $languageCode = null, bool $validate = false)
  {

    // An array of the tagsets stored before the update.
    $tagsetsBefore =
      array_map(
        function ($uuid) {
          return $uuid->toString();
        },
        $this->tagsets()->pluck('uuid')
      );

    // An array of the tagsets after the update.
    $tagsetsAfter =
      array_map(
        function ($tagset) {
          return $tagset['uuid'];
        },
        $input['_tagsets']
      );

    // If there is no change in the tagsets, we ignore the field and proceed with the update.
    if ($tagsetsBefore === $tagsetsAfter) {
      unset($input['_tagsets']);

      return parent::update(
        $input,
        $languageCode,
        $validate
      );
    }

    $mustAdd = array_filter(
      $tagsetsAfter,
      function ($tagset) use ($tagsetsBefore) {
        return !in_array($tagset, $tagsetsBefore);
      }
    );

    $mustRemove = array_filter(
      $tagsetsBefore,
      function ($tagset) use ($tagsetsAfter) {
        return !in_array($tagset, $tagsetsAfter);
      }
    );

    // Add the tag to the tagsets to which it has been added.
    foreach ($mustAdd as $tagsetUuid) {
      $tagset = page($tagsetUuid);
      $tagset->update([
        'tags' => array_merge(
          $tagset->tags()->toPages()->pluck('uuid'),
          [$this->uuid()->toString()]
        ),
      ]);
    }

    // Remove the tag from the tagsets from which it has been removed.
    foreach ($mustRemove as $tagsetUuid) {
      $tagset = page($tagsetUuid);
      $tagset->update([
        'tags' => array_diff(
          $tagset->tags()->toPages()->pluck('uuid'),
          [$this->uuid()->toString()]
        ),
      ]);
    }

    // Proceed with the update, ignoring the tagsets field.
    unset($input['_tagsets']);

    return parent::update(
      $input,
      $languageCode,
      $validate
    );
  }
}
