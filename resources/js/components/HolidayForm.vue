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
          @click="$emit('save', item)"
        >save</button>
      </div>
    </div>

    <small class="d-block text-muted mt-n2" v-if="valid">
      <mark>{{days}}</mark> days
      from <mark>{{item.start_date|date}}</mark>
      until <mark>{{item.end_date|date}}</mark>
    </small>
  </form>
</template>

<script>
export default {
  props: {
    item: { type: Object, default: {} },
  },
  computed: {
    valid: function () {
      return this.item.start_date && this.item.end_date;
    },
    days: function () {
      return moment(this.item.end_date).diff(this.item.start_date, "days");
    },
  },
};
</script>
