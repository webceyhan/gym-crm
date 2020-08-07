<template>
  <div class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between align-items-center">
      <h5>{{item.plan.name}}</h5>

      <span v-if="item.cancelled_at" class="badge badge-danger">cancelled</span>
      <span v-else-if="expired" class="badge badge-secondary">expired</span>
      <div class="btn-group btn-group-sm" v-else>
        <!-- <button class="btn btn-outline-primary" @click="$emit('view')">view</button> -->
        <button class="btn btn-outline-danger" @click="$emit('cancel')">cancel</button>
      </div>
    </div>

    <!-- price -->
    <p class="mb-1">
      {{plan.price|currency}} / {{plan.price/plan.duration|currency}} month,
      <span
        v-if="plan.is_prepaid"
        class="text-info px-2"
      >prepaid</span>
      <span
        v-else-if="item.balance < 0"
        class="text-danger px-2"
      >{{-item.balance|currency}} outstanding</span>
    </p>

    <!-- date -->
    <small class="text-muted mb-1">
      <span>from {{item.start_date |date}} until {{item.end_date |date}}</span>
      <span v-if="active" class="text-info px-2">{{days|humanize}} left</span>
    </small>

    <!-- <small class="text-muted">created on {{item.created_at | timestamp}}</small> -->
  </div>
</template>

<script>
export default {
  props: {
    item: { type: Object },
  },

  computed: {
    plan: function () {
      return this.item.plan;
    },
    days: function () {
      return moment(this.item.end_date).diff(moment(), "days");
    },

    expired: function () {
      return this.days <= 0;
    },
    active: function () {
      return !this.expired && !this.item.cancelled_at;
    },
  },
  filters: {
    humanize(days) {
      return moment.duration(days, "days").humanize();
    },
  },
};
</script>
