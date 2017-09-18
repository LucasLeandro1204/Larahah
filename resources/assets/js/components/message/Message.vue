<template lang="pug">
  p {{ message }}
</template>

<script>
  export default {
    store: ['messages'],

    props: ['type', 'value'],

    computed: {
      message: {
        get () {
          return this.messages[this.type][this.value];
        },

        set (val) {
          this.$set(this.messages[this.type], this.value, val);
        }
      }
    },

    mounted () {
      this.message = 'kkkkkk';
    },
  }
</script>

<style lang="scss" scoped>

</style>
