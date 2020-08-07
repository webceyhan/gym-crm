<template>
  <div class="card">
    <div class="card-body card-img-top position-relative overflow-hidden px-5" style="height:150px">
      <div class="skewed bg-grey"></div>
      <h2 class="text-light m-0 position-relative">{{plan.name}}</h2>
    </div>

    <div class="card-body mt-n4 px-5">
      <h2 class="card-title">
        {{plan.price | currency}}
        <span class="h5 text-muted">/ {{duration}}</span>
      </h2>

      <div class="d-flex align-items-center justify-content-between">
        <h5 class="text-info">{{ plan.price / plan.duration | currency}} / month</h5>
        <h5 class="text-muted">{{ plan.is_prepaid ? 'prepaid' : 'installment' }}</h5>
      </div>

      <hr />
      <ul class="card-text lead ml-n3">
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
