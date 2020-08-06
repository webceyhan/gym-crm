<template>
  <a href="#" @click.prevent="$emit('click')" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between align-items-center">
      <h6 class="mb-1">
        <span class="text-info">{{days}} days</span>,
        <span>from {{item.start_date |date}} until {{item.end_date |date}}</span>
      </h6>
      <button class="btn btn-sm btn-outline-danger" @click.stop="$emit('delete')">delete</button>
    </div>
    <small class="text-muted">created on {{item.created_at | timestamp}}</small>
  </a>
</template>

<script>
export default {
  props: {
    item: { type: Object },
  },
  computed: {
    days: function () {
      return moment(this.item.end_date).diff(this.item.start_date, "days");
    },
  },
};
</script>
