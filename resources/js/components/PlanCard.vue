<template>
  <div class="card card-responsive" @click="$emit('click')">
    <!-- header -->
    <div class="card-header border-0 bg-grey pt-4">
      <h5 class="text-light text-capitalize m-0">{{plan.name}}</h5>
    </div>

    <!-- custom header bottom -->
    <div class="position-relative overflow-hidden mb-n4" style="height:4rem">
      <div class="skewed bg-grey"></div>
    </div>

    <!-- body -->
    <div class="card-body">
      <div class="card-title d-flex align-items-center mb-3">
        <h3 class="m-0">{{plan.price | currency}}</h3>
        <h5 class="text-muted px-2 m-0">{{duration}}</h5>
      </div>

      <h5 class="card-subtitle d-flex align-items-center justify-content-between">
        <span class="text-info">{{ plan.price / plan.duration | currency}} / month</span>
        <span class="text-muted">{{ plan.is_prepaid ? 'prepaid' : 'installment' }}</span>
      </h5>

      <hr />

      <ul class="card-text ml-n3">
        <li class="py-1" v-for="line in descriptionLines" :key="line">{{line}}</li>
      </ul>

      <br />

      <small class="text-muted">created on {{plan.created_at | timestamp}}</small>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    plan: { type: Object, default: {} },
  },
  computed: {
    descriptionLines: function () {
      return this.plan.description.split("\n");
    },
    duration: function () {
      return moment.duration(this.plan.duration, "months").humanize();
    },
  },
};
</script>
