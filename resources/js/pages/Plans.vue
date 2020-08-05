<template>
  <section>
    <h1 class="display-4">plans page</h1>

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
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    async fetch() {
      const url = `/api/plans`;
      const { data } = await axios.get(url);

      this.plans = data.data;
    },
    async onSave(plan) {
      const url = `/api/plans/${plan.id ?? ""}`;
      const { data } = plan.id
        ? await axios.put(url, plan)
        : await axios.post(url, plan);

      // add to list if newly created
      if (!plan.id) this.plans.push(data.data);

      this.selected = null;
    },

    async onDelete(plan) {
      const url = `/api/plans/${plan.id}`;
      const index = this.plans.indexOf(plan);

      await axios.delete(url);

      this.plans.splice(index, 1);
      this.selected = null;
    },
  },
};
</script>
