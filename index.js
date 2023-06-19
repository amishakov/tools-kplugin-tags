panel.plugin("auaust/tags", {
  fields: {
    "tags-tagsets": {
      extends: "k-pages-field",
      props: {
        endpoints: Object,
        value: String,
      },
    },
  },
});
