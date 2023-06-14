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
}
