<?php

return [
  'title' => [
    'fr' => 'Tags',
    'en' => 'Tags'
  ],
  'icon' => 'tag',
  'columns' => [
    [
      'width' => '1/1',
      'sections' => [
        'info' => [
          'type' => 'info',
          'label' => [
            'fr' => 'Logique des tags',
            'en' => 'Tags logic'
          ],
          'text' => [
            'fr' => '| L\'idée des tags est de pouvoir connecter des produits entre eux par les thèmes qu\'ils partagent. Pour les optimiser, il faudrait que chaque tag soit assez spécifique.
Par exemple, un livre sur les chats pourrait avoir le tag "chat", mais on évitera d\'avoir directement le tag "animaux".
Pour compenser la spécificité des tags, les catégories plus générales sont regroupées dans des groupes de tags. Ainsi, le tag "animaux" serait omis de l\'exemple précédent, car le tag "chat" est lui-même dans le groupe de tags "animaux" et donc hérite implicitement de cette classification.',
            'en' => '| The idea of tags is to connect products by the themes they share. To optimize them, each tag should be specific enough.
For example, a book about cats could have the tag "cat", but we will avoid having the tag "animals" directly.
To compensate for the specificity of tags, more general categories are grouped into tag sets. Thus, the tag "animals" would be omitted from the previous example, because the tag "cat" is itself in the tag set "animals" and therefore implicitly inherits this classification.'
          ]
        ]
      ]
    ],
    [
      'width' => '1/2',
      'sections' => [
        'tags' => [
          'type' => 'pages',
          'label' => [
            'fr' => 'Tags',
            'en' => 'Tags'
          ],
          'help' => [
            'fr' => '| Les tags permettent de connecter des produits entre eux par thème.
Ils peuvent être utilisés comme filtres, pour faciliter la recherche, etc.',
            'en' => '| Tags allow to connect products by theme.
They can be used as filters, to facilitate search, etc.'
          ],
          'template' => 'tag',
          'parent' => 'site.find("tags")',
          'layout' => 'table',
          'sortable' => false
        ]
      ]
    ],
    [
      'width' => '1/2',
      'sections' => [
        'tagsets' => [
          'type' => 'pages',
          'label' => [
            'fr' => 'Groupes de tags',
            'en' => 'Tag sets'
          ],
          'help' => [
            'fr' => '| Les groupes de tags permettent de regrouper des tags par thème.
Ils peuvent être utilisés pour connecter des produits, lister des produits par catégorie, etc.',
            'en' => '| Tag sets allow to group tags by theme.
They can be used to connect products, list tags by category, etc.'
          ],
          'template' => 'tagset',
          'parent' => 'site.find("tagsets")',
          'layout' => 'table'
        ]
      ]
    ]
  ]
];
