<template>
  <section>
    <h1 class="display-4">plans</h1>

    <br />

    <div class="row">
      <div class="col-md-6">
        <nav class="d-flex">
          <div class="flex-grow-1 mr-2">
            <input class="form-control" type="search" placeholder="search" v-model="search" />
          </div>

          <div class="flex-fill">
            <div class="btn-toolbar">
              <div class="btn-group mr-auto" role="group">
                <button
                  type="button"
                  class="btn btn-light border-secondary dropdown-toggle"
                  data-toggle="dropdown"
                >
                  <span class="text-muted">sort:</span>
                  {{sort}}
                </button>
                <div class="dropdown-menu">
                  <button
                    v-for="opt in sortOptions"
                    :key="opt"
                    @click="sort = opt"
                    class="dropdown-item"
                  >{{opt}}</button>
                </div>
              </div>

              <router-link class="btn btn-primary text-capitalize" to="/plans/new">create plan</router-link>
            </div>
          </div>
        </nav>

        <br />

        <plan-list
          :plans="filteredPlans"
          :selected="selected"
          @select="selected = $event"
          @delete="onDelete($event)"
        />
      </div>
      <div class="col offset-md-1" v-if="selected">
        <plan-card class="shadow" :plan="selected" />
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
      resource: this.createResource("/plans"),
      search: "",
      sort: "recent",
      sortOptions: ["recent", "oldest"],
    };
  },
  computed: {
    filteredPlans() {
      const filterer = (p) => p.name.match(new RegExp(this.search, "i"));

      // default : recent
      let sorter = (a, b) => (a.id > b.id ? -1 : 1);

      if (this.sort === "oldest") {
        sorter = (a, b) => (a.id > b.id ? 1 : -1);
      }

      return this.plans.filter(filterer).sort(sorter);
    },
  },

  created() {
    this.fetch();
  },
  methods: {
    async fetch() {
      this.plans = await this.resource.list();
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
