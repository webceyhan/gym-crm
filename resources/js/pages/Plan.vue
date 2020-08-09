<template>
  <section v-if="plan">
    <breadcrumb
      :items="[
        {label:'plans', link: '/plans'},
        {label: plan.name || 'new plan'}
        ]"
    />

    <div class="row">
      <div class="col-md-5">
        <plan-card class="shadow" :plan="plan" />
      </div>
      <div class="col offset-1">
        <plan-form :plan="plan" @save="onSave($event)" @delete="onDelete($event)" />
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      plan: {
        price: 0,
        extra_fee: 0,
        duration: 12,
        is_prepaid: true,
      },
      resource: this.createResource("/plans"),
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    async fetch() {
      const { id } = this.$route.params;

      if (id !== "new") {
        this.plan = await this.resource.get(id);
      }
    },
    async onSave(data) {
      this.plan = await this.resource.save(data);
    },
    async onDelete(plan) {
      this.resource.delete(plan.id);
      this.$router.push({ path: "/plans" });
    },
  },
};
</script>
