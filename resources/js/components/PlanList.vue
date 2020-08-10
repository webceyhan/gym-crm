<template>
  <div class="list-group list-group-flush shadow">
    <plan-list-item
      v-for="plan in plans"
      :key="plan.id"
      :plan="plan"
      :class="classOf(plan)"
      @select="$emit('select', plan)"
      @delete="$emit('delete', plan)"
    />
  </div>
</template>

<script>
export default {
  props: {
    selected: null,
    plans: { type: Array, default: [] },
  },
  methods: {
    classOf(plan) {
      return { active: plan.id === (this.selected || {}).id };
    },
  },
};
</script>
