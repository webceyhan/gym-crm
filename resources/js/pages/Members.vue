<template>
  <section>
    <h1 class="display-4">members</h1>

    <br />

    <div class="row">
      <div class="col-md-5">
        <button class="btn btn-primary" @click="selected = {}">create new member</button>

        <br />
        <br />

        <div class="overflow-auto" style="height: 50vh">
          <member-list :members="members" @select="selected = $event"></member-list>
        </div>
      </div>
      <div class="col" v-if="selected">
        <!-- tabs -->
        <nav class="nav nav-tabs">
          <a
            v-for="(tab, index) in tabs"
            :key="tab"
            :href="`#${tab}`"
            data-toggle="tab"
            class="nav-item nav-link"
            :class="{active: !index}"
          >{{tab}}</a>
        </nav>

        <br />
        <br />

        <!-- tab content -->
        <div class="tab-content">
          <div class="tab-pane fade active show" id="profile">
            <member-form
              :member="selected"
              @save="onSave($event)"
              @cancel="selected = null"
              @delete="onDelete($event)"
            ></member-form>
          </div>
          <div class="tab-pane fade" id="attachments">
              <attachment-list :member="selected"></attachment-list>
          </div>
          <div class="tab-pane fade" id="relatives">
              <relative-list :member="selected"></relative-list>
          </div>
          <div class="tab-pane fade" id="holidays">
              <holiday-list :member="selected"></holiday-list>
          </div>
          <div class="tab-pane fade" id="subscriptions">subscriptions</div>
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
      resource: this.createResource("/members"),
      tabs: [
        "profile",
        "attachments",
        "relatives",
        "holidays",
        "subscriptions",
      ],
    };
  },
  created() {
    this.fetch();
  },
  methods: {
    async fetch() {
      this.members = await this.resource.list();
    },
    async onSave(data) {
      const plan = await this.resource.save(data);

      // add to list if newly created
      if (!data.id) this.members.push(plan);
      this.selected = null;
    },

    async onDelete(plan) {
      await this.resource.delete(plan.id);
      const index = this.members.indexOf(plan);

      // remove from list
      this.members.splice(index, 1);
      this.selected = null;
    },
  },
};
</script>
