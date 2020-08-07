<template>
  <form>
    <div class="form-row align-items-end">
      <!-- name searcher -->
      <div class="form-group col">
        <label for="name" required>plan</label>
        <typeahead-input
          placeholder="type to search.."
          v-model="plan.name"
          :data="suggestions"
          :serializer="s => s.name"
          @input="onLookup($event)"
          @hit="onLookupSelect($event)"
        ></typeahead-input>
      </div>

      <!-- buttons -->
      <div class="form-group col-auto">
        <button
          type="button"
          class="btn btn-outline-primary"
          :disabled="!valid"
          @click="onSave()"
        >subscribe</button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      plan: {
        id: null,
        name: null,
        price: null,
      },
      suggestions: [],
    };
  },
  computed: {
    valid: function () {
      return !!this.plan.id;
    },
    planRes: function () {
      return this.createResource("/plans");
    },
  },
  methods: {
    onReset() {
      for (let key in this.plan) {
        this.plan[key] = null;
      }
    },
    onSave() {
      this.$emit("save", { ...this.plan });
      this.onReset();
    },
    onLookup(query) {
      _.debounce(async () => {
        this.suggestions = await this.planRes.list({
          "fields[plans]": "id,name,price",
          "filter[name]": query,
        });
      }, 500)();
    },
    onLookupSelect(value) {
      this.plan.id = value.id;
      this.plan.name = value.name;
      this.plan.price = value.price;
    },
  },
};
</script>
