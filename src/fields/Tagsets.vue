<!--
  This whole component is mostly based on Kirby's pages field:
  https://github.com/getkirby/kirby/blob/3.9.5/panel/src/components/Forms/Field/PagesField.vue
-->
<script>
export default {
  extends: "k-pages-field",
  computed: {
    emptyProps() {
      return {
        icon: "tag",
        text: this.empty || this.$t("field.pages.empty"),
      };
    },
  },
};
</script>
