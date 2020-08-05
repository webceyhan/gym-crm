<style>
/* .list-group-item p {
  overflow: hidden;
  height: 20px;
  line-height: 20px;
  white-space: break-spaces;
} */
</style>

<template>
  <div class="list-group">
    <a
      v-for="plan in plans"
      :key="plan.id"
      href="#"
      class="list-group-item list-group-item-action"
      :class="{active: plan === selected}"
      @click.prevent="onClick(plan)"
    >
      <div class="d-flex w-100 justify-content-between">
        <div>
          <h5>{{plan.name}}</h5>
          <!-- <p class="mb-1">{{plan.description}}</p> -->
          <small class="text-muted">created on {{plan.created_at | date}}</small>
        </div>
        <div class="text-right text-nowrap">
          <h5>{{plan.price}} €</h5>
          <small class="text-muted">{{ plan.price / plan.duration | currency}} / month</small>
        </div>
      </div>
    </a>
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
    onClick(plan) {
      this.selected = plan;
      this.$emit("select", plan);
    },
  },
};
</script>
