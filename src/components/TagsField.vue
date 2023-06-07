<template>
  <div>
    <label for="textfield">{{ tagset }}</label>
    <input type="text" name="textfield" />
  </div>
</template>

<script>
export default {
  props: {
    tagset: String,
  },
};
</script>
