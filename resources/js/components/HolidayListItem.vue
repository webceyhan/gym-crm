<template>
  <a href="#" @click.prevent="$emit('click')" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between align-items-center">
      <h5 class="mb-1">
        {{item.start_date |date}} until {{item.end_date |date}}
        - {{days}} days
      </h5>
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
