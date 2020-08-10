<template>
  <section>
    <breadcrumb :items="[{label:'members'}]" />

    <h1 class="display-4">members</h1>

    <br />

    <div class="row">
      <div class="col-md-6">
        <nav class="d-flex">
          <div class="flex-grow-1 mr-2">
            <input
              class="form-control"
              type="search"
              placeholder="search"
              v-model="query.filter.name"
            />
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
                  {{sortOptions[query.sort]}}
                </button>
                <div class="dropdown-menu">
                  <button
                    v-for="(label, key) in sortOptions"
                    :key="key"
                    @click="query.sort = key"
                    class="dropdown-item"
                  >{{label}}</button>
                </div>
              </div>

              <router-link class="btn btn-primary text-capitalize" to="/members/new">create member</router-link>
            </div>
          </div>
        </nav>

        <br />

        <div class="overflow-auto shadow" style="max-height: 50vh">
          <member-list
            :members="members"
            :selected="selected"
            @select="onSelect($event)"
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
import { mapActions, mapGetters, mapMutations } from "vuex";

export default {
  data() {
    return {
      sortOptions: {
        id: "recent",
        "-id": "oldest",
      },
      query: {
        sort: null,
        filter: {
          name: null,
        },
      },
    };
  },

  watch: {
    query: {
      deep: true,
      handler: _.debounce(function(q){ this.load(q)}, 100),
    },
  },
  computed: {
    ...mapGetters({
      members: "members/list",
      selected: "members/selected",
    }),
  },
  methods: {
    ...mapMutations({
      onSelect: "members/select",
    }),

    ...mapActions({
      load: "members/load",
      onCheck: "members/check",
      onDelete: "members/delete",
    }),

    onBrowse(selected) {
      this.$router.push(`/members/${selected.id}`);
    },
  },
  created() {
    this.load();
  },
};
</script>
