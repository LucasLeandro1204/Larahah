<template lang="pug">
  .block.message
    p Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tempus, massa sed mattis suscipit, neque lorem ullamcorper enim, sit amet mine.
    span September 10th 2017, 5:13 am
    .actions
      a(href="#")
        i.fa.fa-ban
      a(href="#")
        i.fa.fa-star
    message(:type="type", :value="0")
</template>

<script>
  import Message from './Message.vue';

  export default {
    components: {
      Message,
    },

    props: ['type'],
  }
</script>

<style lang="scss" scoped>
  @import "~@/core/variables";

  .message {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    padding-bottom: 10px;
    border-bottom: 1px solid $white + -15%;

    p {
      flex: 100%;
      font-size: 12px;
      margin-bottom: 5px;

      &::first-letter {
        margin-left: 5px;
      }
    }

    span {
      font-size: 11px;
    }

    .actions {
      margin-left: auto;

      a {
        color: $gray-dark;

        &:not(:first-child) {
          margin-left: 8px;
        }

        &:hover,
        &.active {
          .fa-ban {
            color: $red;
          }

          .fa-star {
            color: $yellow;
          }
        }
      }
    }
  }
</style>
