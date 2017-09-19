<template lang="pug">
  .block.message
    p Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tempus, massa sed mattis suscipit, neque lorem ullamcorper enim, sit amet mine.
    span September 10th 2017, 5:13 am
    .actions
      a(href="#")
        i.fa.fa-ban
      a(href="#")
        i.fa.fa-star
</template>

<script>
  export default {
    store: ['messages'],

    props: ['type', 'value'],

    computed: {
      message: {
        get () {
          return this.messages[this.type]['data'][this.value];
        },

        set (val) {
          this.$set(this.messages[this.type], this.value, val);
        }
      }
    },
  }
</script>

<style lang="scss" scoped>

</style>
