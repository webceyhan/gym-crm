<template>
  <form @submit.prevent="$emit('save', member)">
    <!-- name -->
    <div class="form-group">
      <label for="name" required>name</label>
      <input id="name" type="text" class="form-control" v-model="member.name" required />
    </div>

    <!-- ssn -->
    <div class="form-group">
      <label for="ssn" required>social security number</label>
      <input id="ssn" type="text" class="form-control" v-model="member.ssn" required />
    </div>

    <!-- gender -->
    <div class="form-group">
      <label required>gender</label>
      <div>
        <div class="form-check form-check-inline" v-for="opt in ['male', 'female']" :key="opt">
          <input
            type="radio"
            class="form-check-input"
            v-model="member.gender"
            :id="`gender-${opt}`"
            :value="opt"
          />
          <label class="form-check-label" :for="`gender-${opt}`">{{opt}}</label>
        </div>
      </div>
    </div>

    <!-- birth date/place -->
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="birth_date" required>birth date</label>
        <input
          id="birth_date"
          type="date"
          class="form-control"
          v-model="member.birth_date"
          required
        />
      </div>
      <div class="form-group col">
        <label for="birth_place">birth place</label>
        <input id="birth_place" type="text" class="form-control" v-model="member.birth_place" />
      </div>
    </div>

    <!-- phone/email -->
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="phone">phone</label>
        <input id="phone" type="text" class="form-control" v-model="member.phone" />
      </div>
      <div class="form-group col">
        <label for="email">email</label>
        <input id="email" type="email" class="form-control" v-model="member.email" />
      </div>
    </div>

    <!-- address -->
    <div class="form-group">
      <label for="address">address</label>
      <input id="address" type="text" class="form-control" v-model="member.address" />
    </div>

    <!-- notes -->
    <div class="form-group">
      <label for="notes">notes</label>
      <textarea id="notes" class="form-control" rows="5" v-model="member.notes"></textarea>
    </div>

    <button class="btn btn-primary">save</button>
  </form>
</template>

<script>
export default {
  props: {
    member: { type: Object, default: {} },
  },
};
</script>
