<?php

use Kirby\Cms\Page;

class TagPage extends Page
{
  public function tagsets()
  {
    $tagsets = option('auaust.tags.tagSetsPage')->children()->filter(
      function ($tagset) {
        return $this->tags()->toPages()->has($tagset);
      }
    );
    return $tagsets;
  }
}
