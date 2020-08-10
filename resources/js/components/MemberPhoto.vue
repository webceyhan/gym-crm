<template>
  <img :src="src" @error="fallback = true" />
</template>

<script>
export default {
  props: {
    member: { type: Object },
  },
  data() {
    return {
      fallback: false,
      avatar: {
        male: "/img/avatar-male.jpg",
        female: "/img/avatar-female.jpg",
      },
    };
  },
  computed: {
    src() {
      const { photo, gender } = this.member;
      const avatar = this.avatar[gender || "male"];

      return this.fallback ? avatar : photo || avatar;
    },
  },
};
</script>
