<template>
  <form>
    <div class="form-row align-items-end">
      <!-- start date -->
      <div class="form-group col">
        <label for="start_date" required>start date</label>
        <input id="start_date" type="date" class="form-control" v-model="item.start_date" required />
      </div>

      <!-- end date -->
      <div class="form-group col">
        <label for="end_date" required>end date</label>
        <input
          id="end_date"
          type="date"
          class="form-control"
          :min="item.start_date"
          v-model="item.end_date"
          required
        />
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

    <small class="d-block text-muted mt-n2" v-if="valid">
      <span>{{days}} days</span>,
      <span>from {{item.start_date|date}} until {{item.end_date|date}}</span>
    </small>
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
        start_date: null,
        end_date: null,
      },
    };
  },
  computed: {
    valid: function () {
      return this.item.start_date && this.item.end_date;
    },
    days: function () {
      return moment(this.item.end_date).diff(this.item.start_date, "days");
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
    onSave() {
      this.$emit("save", { ...this.item });
      this.setItem({}); // reset
    },
  },
};
</script>
