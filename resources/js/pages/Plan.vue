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
        <!-- tabs -->
        <nav class="nav nav-tabs">
          <a
            v-for="(tab) in tabs"
            :key="tab"
            class="nav-item nav-link pointer"
            :class="{active: tab === activeTab}"
            @click="activeTab = tab"
          >{{tab}}</a>
          <li class="nav-item dropdown ml-auto">
            <a class="nav-link pointer" data-toggle="dropdown">
              <i class="fas fa-fw fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <router-link class="dropdown-item" :to="`/members?planId=${plan.id}`">Browse members</router-link>
              <router-link
                class="dropdown-item"
                :to="`/subscriptions?planId=${plan.id}`"
              >Browse subscriptions</router-link>
              <div class="dropdown-divider"></div>
              <button class="dropdown-item" @click="onDelete()">Delete</button>
            </div>
          </li>
        </nav>

        <br />

        <!-- tab content -->
        <div class="tab-content">
          <div class="tab-pane fade active show" v-if="activeTab === 'general'">
            <plan-form :plan="plan" @save="onSave($event)" />
          </div>

          <div
            class="tab-pane fade active show"
            v-if="activeTab === 'statistics'"
          >here comes the statistics per plan</div>
        </div>
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
      tabs: ["general", "statistics"],
      activeTab: "general",
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
    async onDelete() {
      this.resource.delete(this.plan.id);
      this.$router.push({ path: "/plans" });
    },
  },
};
</script>
