<template>
  <form>
    <div class="form-row align-items-end">
      <!-- name searcher -->
      <div class="form-group col">
        <label for="name" required>name</label>
        <typeahead-input
          placeholder="type to search.."
          v-model="item.name"
          :data="suggestions"
          :serializer="s => s.name"
          @input="onLookup($event)"
          @hit="onLookupSelect($event)"
        ></typeahead-input>
      </div>

      <!-- type -->
      <div class="form-group col-4">
        <label for="type" required>type</label>
        <select id="type" class="form-control" v-model="item.type">
          <option v-for="opt in types" :key="opt" :value="opt">{{opt}}</option>
        </select>
      </div>

      <!-- buttons -->
      <div class="form-group col-auto">
        <button
          type="button"
          class="btn btn-outline-primary"
          :disabled="!valid"
          @click="onSave()"
        >add</button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      item: {
        member_id: null,
        name: null,
        type: "sibling",
      },
      types: ["sibling", "family", "friend"],
      suggestions: [],
    };
  },
  computed: {
    valid: function () {
      return this.item.member_id && this.item.type;
    },
    memberRes: function () {
      return this.createResource("/members");
    },
  },
  methods: {
    onReset() {
      for (let key in this.item) {
        this.item[key] = null;
      }

      // set default type
      this.item.type = this.types[0];
    },
    onSave() {
      this.$emit("save", { ...this.item });
      this.onReset();
    },
    onLookup(query) {
      _.debounce(async () => {
        this.suggestions = await this.memberRes.list({
          "fields[members]": "id,name",
          "filter[name]": query,
        });
      }, 500)();
    },
    onLookupSelect(value) {
      this.item.member_id = value.id;
    },
  },
};
</script>
