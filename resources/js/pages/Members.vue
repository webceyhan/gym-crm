<template>
  <section>
    <breadcrumb :items="[{label:'members'}]" />

    <h1 class="display-4">members</h1>

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

              <router-link class="btn btn-primary text-capitalize" to="/members/new">create member</router-link>
            </div>
          </div>
        </nav>

        <br />

        <div class="overflow-auto shadow" style="max-height: 50vh">
          <member-list
            :members="filteredMembers"
            :selected="selected"
            @select="selected = $event"
            @check="onCheck($event)"
            @delete="onDelete($event)"
          />
        </div>
      </div>

      <div class="col offset-md-1">
        <member-card
          v-if="selected"
          :member="selected"
          class="shadow-sm card-action"
          @click="onBrowse(selected)"
        />

        <div v-else class="card bg-transparent flex-fill my-5">
          <div class="card-body text-center p-5">
            <p class="card-text">Select a member from the left menu to see the details!</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      members: [],
      selected: null,
      search: "",
      sort: "recent",
      sortOptions: ["recent", "oldest"],
      resource: this.createResource("/members"),
    };
  },
  computed: {
    filteredMembers() {
      const filterer = (m) => m.name.match(new RegExp(this.search, "i"));

      // default : recent
      let sorter = (a, b) => (a.id > b.id ? -1 : 1);

      if (this.sort === "oldest") {
        sorter = (a, b) => (a.id > b.id ? 1 : -1);
      }

      return this.members.filter(filterer).sort(sorter);
    },
  },
  created() {
    this.fetch();
  },
  methods: {
    async fetch() {
      this.members = await this.resource.list();
    },
    async onCheck({ id, status }) {
      const member = await this.resource.save({ id, status });
      const index = this.members.findIndex((m) => m.id === id);

      this.members.splice(index, 1, member);
      this.selected = member;
    },

    async onDelete(plan) {
      await this.resource.delete(plan.id);
      const index = this.members.indexOf(plan);

      // remove from list
      this.members.splice(index, 1);
      this.selected = null;
    },
    onBrowse(selected) {
      this.$router.push(`/members/${selected.id}`);
    },
  },
};
</script>
