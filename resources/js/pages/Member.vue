<template>
  <section v-if="member">
    <breadcrumb
      :items="[
        {label:'members', link: '/members'},
        {label: member.name || 'new member'}
        ]"
    />

    <div class="row">
      <div class="col-md-4">
        <member-card class="shadow" :member="member" />
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
        </nav>

        <br />

        <!-- tab content -->
        <div class="tab-content">
          <div class="tab-pane fade active show" v-if="activeTab === 'profile'">
            <member-form :member="member" @save="onSave($event)" @delete="onDelete($event)" />
          </div>
          <div class="tab-pane fade active show" v-if="activeTab === 'attachments'">
            <attachment-list :member="member" />
          </div>
          <div class="tab-pane fade active show" v-if="activeTab === 'relatives'">
            <relative-list :member="member" />
          </div>
          <div class="tab-pane fade active show" v-if="activeTab === 'holidays'">
            <holiday-list :member="member" />
          </div>
          <div class="tab-pane fade active show" v-if="activeTab === 'subscriptions'">
            <subscription-list :member="member" />
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
      member: {
        gender: "male",
      },
      resource: this.createResource("/members"),
      tabs: [
        "profile",
        "attachments",
        "relatives",
        "holidays",
        "subscriptions",
      ],
      activeTab: "profile",
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    async fetch() {
      const { id } = this.$route.params;

      if (id !== "new") {
        this.member = await this.resource.get(id);
      }
    },
    async onSave(data) {
      this.member = await this.resource.save(data);
    },
    async onDelete(member) {
      this.resource.delete(member.id);
      this.$router.push({ path: "/members" });
    },
  },
};
</script>
