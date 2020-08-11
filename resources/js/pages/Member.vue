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
          <li class="nav-item dropdown ml-auto">
            <a class="nav-link pointer" data-toggle="dropdown">
              <i class="fas fa-fw fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <button
                v-if="member.status=='outside'"
                class="dropdown-item"
                @click="onCheck({...member, on: true})"
              >check in</button>
              <button
                v-if="member.status=='inside'"
                class="dropdown-item"
                @click="onCheck({...member, on: false})"
              >check out</button>
              <div v-if="member.status!='away'" class="dropdown-divider"></div>
              <button class="dropdown-item" @click="onDelete(member)">Delete</button>
            </div>
          </li>
        </nav>

        <br />

        <!-- tab content -->
        <div class="tab-content">
          <div class="tab-pane fade active show" v-if="activeTab === 'profile'">
            <member-form :member="member" @save="onSave($event)" />
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
import { mapActions, mapGetters } from "vuex";

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
  watch: {
    selected: {
      deep: true,
      handler(value) {
        value && (this.member = value);
      },
    },
  },
  computed: {
    ...mapGetters({
      selected: "members/selected",
    }),
  },

  methods: {
    ...mapActions({
      load: "members/select",
      onCheck: "members/check",
      onSave: "members/save",
    }),
    async onDelete(member) {
      await this.$store.dispatch("members/delete", member);
      this.$router.push({ path: "/members" });
    },
  },

  async created() {
    if (this.$route.params.id != "new") {
      this.load(this.$route.params);
    }
  },
};
</script>
