<style>
.card-img-top {
  object-fit: contain;
  height: 250px;
}
</style>

<template>
  <div class="card card-responsive" @click="$emit('click')">
    <!-- photo -->
    <member-photo :member="member" class="card-img-top" />

    <!-- custom header-top -->
    <div class="position-relative overflow-hidden mt-n5" style="height:3rem">
      <div class="bg-grey skew-up"></div>
    </div>

    <!-- header -->
    <div class="-card-body bg-grey text-light py-4 px-5">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-capitalize m-0">{{member.name}}</h3>
        <span class="badge" :class="statusClass">{{member.status}}</span>
      </div>
    </div>

    <!-- body -->
    <div class="card-body">
      <h5 class="card-subtitle text-muted">{{member.birth_date | diff}} years old, {{member.gender}}</h5>
      <hr />

      <dl>
        <dt>birth date</dt>
        <dd>
          {{member.birth_date | date}}
          <span v-if="member.birth_place">({{member.birth_place}})</span>
        </dd>

        <template v-if="member.address">
          <dt>address</dt>
          <dd>{{member.address}}</dd>
        </template>

        <template v-if="member.phone">
          <dt>phone</dt>
          <dd>{{member.phone}}</dd>
        </template>

        <template v-if="member.email">
          <dt>email</dt>
          <dd>{{member.email}}</dd>
        </template>
      </dl>

      <br />

      <small class="text-muted">created on {{member.created_at | timestamp}}</small>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    member: { type: Object },
  },
  computed: {
    statusClass() {
      switch (this.member.status) {
        case "inside":
          return ["badge-success"];
        case "outside":
          return ["badge-primary"];
        default:
          return ["badge-secondary"];
      }
    },
  },
};
</script>
