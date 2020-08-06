<template>
  <form>
    <!-- name -->
    <div class="form-group">
      <label for="name" required>name</label>
      <input id="name" type="text" class="form-control" v-model="item.name" required />
    </div>

    <div class="form-row">
      <!-- file -->
      <div class="form-group col">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="filename" required />
          <label class="custom-file-label" for="filename">
              {{item.filename || 'choose a file'}}
            </label>
        </div>
      </div>
      <!-- buttons -->
      <div class="form-group col-auto">
        <button
          type="button"
          class="btn btn-outline-primary"
          :disabled="!valid"
          @click="$emit('save', item)"
        >save</button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  props: {
    item: { type: Object, default: {} },
  },
  computed: {
    valid: function () {
      return this.item.name && this.item.filename;
    },
  },
};
</script>
