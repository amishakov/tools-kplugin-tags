panel.plugin("auaust/tags", {
  fields: {
    tags: {
      props: {
        tagset: String,
      },
      template: "<p>{{ tagset }}</p>",
    },
  },
});
