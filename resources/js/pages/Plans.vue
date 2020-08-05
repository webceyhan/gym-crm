<template>
  <section>
    <h1 class="display-4">plans</h1>

    <br />

    <div class="row">
      <div class="col-6">
        <button class="btn btn-primary" @click="selected = {}">create new plan</button>

        <br />
        <br />

        <plan-list :plans="plans" @select="selected = $event"></plan-list>
      </div>
      <div class="col" v-if="selected">
        <plan-form
          :plan="selected"
          @save="onSave($event)"
          @cancel="selected = null"
          @delete="onDelete($event)"
        ></plan-form>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      plans: [],
      selected: null,
      resource : this.createResource("/plans")
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    async fetch() {
      this.plans = await this.resource.list();
    },
    async onSave(data) {
      const plan = await this.resource.save(data);

      // add to list if newly created
      if (!data.id) this.plans.push(plan);
      this.selected = null;
    },

    async onDelete(plan) {
      await this.resource.delete(plan.id);
      const index = this.plans.indexOf(plan);

      // remove from list
      this.plans.splice(index, 1);
      this.selected = null;
    },
  },
};
</script>
