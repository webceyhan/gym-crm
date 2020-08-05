<style>
/* .list-group-item p {
  overflow: hidden;
  height: 20px;
  line-height: 20px;
  white-space: break-spaces;
} */
</style>

<template>
  <div class="list-group">
    <a v-for="plan in plans" :key="plan.id" href="#" class="list-group-item list-group-item-action">
      <div class="d-flex w-100 justify-content-between">
        <div>
          <h5>{{plan.name}}</h5>
          <!-- <p class="mb-1">{{plan.description}}</p> -->
          <small class="text-muted">{{plan.created_at}}</small>
        </div>
        <div class="text-right text-nowrap">
          <h5>{{plan.price}} €</h5>
          <small class="text-muted">{{ plan.price / plan.duration | currency}} / month</small>
        </div>
      </div>
    </a>
  </div>

  <!-- <div class="row row-cols-1 row-cols-md-3">
    <div class="col mb-4" v-for="plan in plans" :key="plan.id">
      <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{plan.name}}</h5>
          <pre class="card-text" style="white-space:break-spaces">{{plan.description}}</pre>
          <textarea class="form-control"  rows="3" v-model="plan.description"></textarea>
          <button class="btn btn-primary" @click="save(plan)">save</button>
        </div>
      </div>
    </div>
  </div>-->
</template>

<script>
export default {
  data() {
    return {
      plans: [],
    };
  },
  methods: {
    async fetch() {
      const url = "/api/plans";
      const { data } = await axios.get(url);

      this.plans = data.data;
    },
    async save(plan) {
      const url = `/api/plans/${plan.id}`;
      const { data } = await axios.put(url, plan);
    },
  },
  mounted() {
    this.fetch();
  },
  filters: {
    currency(value) {
      return +value.toFixed(2) + " €";
    },
  },
};
</script>
