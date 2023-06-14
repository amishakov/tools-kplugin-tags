panel.plugin("auaust/tags", {
  fields: {
    "tags-tagsets": {
      extends: "k-pages-field",
      methods: {
        onInput() {
          console.log(this);
        },
      },
    },
  },
});
