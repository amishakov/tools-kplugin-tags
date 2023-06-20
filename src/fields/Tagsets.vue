<!--
  This whole component is mostly based on Kirby's pages field:
  https://github.com/getkirby/kirby/blob/3.9.5/panel/src/components/Forms/Field/PagesField.vue
-->
<template>
  <k-field v-bind="$props" :label="label" :help="help" class="k-pages-field">
    <template #options>
      <k-button-group class="k-field-options">
        <k-button
          icon="add"
          :text="$t('select')"
          class="k-field-options-button"
          @click="open"
        />
      </k-button-group>
    </template>
    <k-collection
      v-bind="{
        empty: this.emptyProps,
        items: this.selected,
        layout: 'table',
        link: this.link,
        size: this.size,
        sortable: !this.disabled && this.selected.length > 1,
      }"
      @empty="open"
      @sort="onInput"
      @sortChange="$emit('change', $event)"
    >
      <template #options="{ index }">
        <k-button
          v-if="!disabled"
          :tooltip="$t('remove')"
          icon="remove"
          @click="remove(index)"
        />
      </template>
    </k-collection>

    <k-pages-dialog ref="selector" @submit="select" />
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
  extends: "k-pages-field",
  props: {
    selected: {
      type: Array,
      default: () => [],
    },
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
