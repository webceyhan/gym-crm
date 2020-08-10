<template>
  <div class="card card-responsive" @click="$emit('click')">
    <!-- header -->
    <div class="card-header border-0 bg-grey pt-4">
      <h5 class="text-light text-capitalize m-0">{{plan.name}}</h5>
    </div>

    <!-- custom header-bottom -->
    <div class="position-relative overflow-hidden mb-n4" style="height:3rem">
      <div class="bg-grey skew-down"></div>
    </div>

    <!-- body -->
    <div class="card-body">
      <div class="card-title d-flex align-items-center mb-3">
        <h3 class="m-0">{{plan.price | currency}}</h3>
        <h5 class="text-muted px-2 m-0">/ {{plan.duration | humanize}}</h5>
      </div>

      <h5 class="card-subtitle d-flex align-items-center justify-content-between">
        <span class="text-info">{{ plan.price / plan.duration | currency}} / month</span>
        <span class="text-muted">{{ plan.is_prepaid ? 'prepaid' : 'installment' }}</span>
      </h5>

      <hr />

      <p class="card-text text-prewrap">{{plan.description}}</p>

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
};
</script>
