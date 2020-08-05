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
        <member-form
          :member="selected"
          @save="onSave($event)"
          @cancel="selected = null"
          @delete="onDelete($event)"
        ></member-form>
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
