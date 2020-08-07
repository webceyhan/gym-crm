<template>
  <a class="list-group-item list-group-item-action pointer" @click="$emit('select', plan)">
    <h5 class="d-flex w-100 justify-content-between">
      <span>{{plan.name}}</span>
      <span>{{plan.price | currency}}</span>
    </h5>
    <small class="d-flex w-100 justify-content-between">
      <span class="text-muted">created on {{plan.created_at | timestamp}}</span>
      <span class="text-info">{{ plan.price / plan.duration | currency}} / month</span>
    </small>
  </a>
</template>

<script>
export default {
  props: {
    plan: { type: Object, default: {} },
  },
};
</script>
