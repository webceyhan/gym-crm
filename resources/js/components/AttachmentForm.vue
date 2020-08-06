<template>
  <form enctype="multipart/form-data">
    <!-- name -->
    <div class="form-group">
      <label for="name" required>name</label>
      <input id="name" type="text" class="form-control" v-model="item.name" required />
    </div>

    <div class="form-row">
      <!-- file -->
      <div class="form-group col">
        <div class="custom-file">
          <input
            type="file"
            id="filename"
            class="custom-file-input"
            @change="onFileSelect($event)"
            required
          />
          <label class="custom-file-label" for="filename">{{item.filename || 'choose a file'}}</label>
        </div>
      </div>
      <!-- buttons -->
      <div class="form-group col-auto">
        <button
          type="button"
          class="btn btn-outline-primary"
          :disabled="!valid"
          @click="onSave()"
        >save</button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  props: {
    value: { type: Object, default: {} },
  },
  data() {
    return {
      item: {
        id: null,
        name: null,
        filename: null,
      },
    };
  },
  computed: {
    valid: function () {
      return this.item.name && this.item.filename;
    },
  },
  watch: {
    value() {
      // copy value to item
      this.setItem(this.value);
    },
  },
  methods: {
    setItem(item) {
      for (let key in this.item) {
        this.item[key] = (item || {})[key];
      }
    },
    onFileSelect(event) {
      const [file] = event.target.files;
      this.item.filename = file.name;
      this.item.file = file;
    },
    onSave() {
      // create form data
      const data = new FormData();

      // add id, file, name
      data.id = this.item.id;
      data.append("file", this.item.file);
      data.append("name", this.item.name);

      this.$emit("save", data);
      this.setItem({}); // reset
    },
  },
};
</script>
