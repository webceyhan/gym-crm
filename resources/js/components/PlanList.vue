<template>
  <div class="list-group">
    <plan-list-item
      v-for="plan in plans"
      :key="plan.id"
      :plan="plan"
      :class="{active: plan === selected}"
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
    onSelect(plan) {
      this.selected = plan;
      this.$emit("select", plan);
    },
  },
};
</script>
