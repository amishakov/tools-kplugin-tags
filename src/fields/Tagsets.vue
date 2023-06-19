<template>
  <k-field v-bind="$props" :label="label" :help="help" class="k-pages-field">
    <template #options>
      <k-button-group class="k-field-options">
        <k-button
          icon="add"
          :text="this.$t('select')"
          class="k-field-options-button"
          @click="open"
        />
      </k-button-group>
    </template>
    <k-empty layout="list" icon="tag" :text="this.$t('field.tagsets.empty')" />
    <!-- <k-icon :type="emptyProps.icon" />
    label:
    <br />
    {{ label }}
    <br />
    <br />
    endpoints:
    {{ endpoints }}
    <br />
    <br />
    value:
    <pre>{{ JSON.stringify(value, null, 4) }}</pre>
    <br />
    <br />
    emptyProps:
    {{ emptyProps }} -->
  </k-field>
</template>

<script>
export default {
  props: {
    label: String,
    help: String,
    endpoints: Object,
    value: String,
  },
  computed: {
    emptyProps() {
      return {
        icon: "tag",
        text: this.empty || this.$t("field.tagsets.empty"),
      };
    },
  },
};
</script>

<style></style>
