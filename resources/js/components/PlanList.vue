<template>
  <div class="list-group list-group-flush shadow">
    <plan-list-item
      v-for="plan in plans"
      :key="plan.id"
      :plan="plan"
      :class="classOf(plan)"
      @select="onSelect($event)"
    />
  </div>
</template>

<script>
export default {
  props: {
    plans: { type: Array, default: [] },
  },
  data() {
    return {
      selected: null,
    };
  },
  methods: {
    classOf(plan) {
      return { active: plan === this.selected };
    },
    onSelect(plan) {
      this.selected = plan;
      this.$emit("select", plan);
    },
  },
};
</script>
