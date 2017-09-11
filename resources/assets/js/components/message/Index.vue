<template lang="pug">
  section
    .container
      h1 Messages
      article.content
        nav.block
          ul
            li
              a(href="#").active
                i.fa.fa-inbox
                span RECEIVED
            li
              a(href="#")
                i.fa.fa-star
                span FAVORITES
            li
              a(href="#")
                i.fa.fa-paper-plane
                span SENT
        larahah-message
</template>

<script>
  import LarahahMessage from './Message.vue';

  export default {
    components: {
      LarahahMessage,
    }
  }
</script>

<style lang="scss" scoped>
  @import "~@/core/variables";

  .container {
    flex-direction: column;
  }

  nav {
    border-bottom: 4px solid $primary + 15%;

    li {
      flex: 1;
      text-align: center;

      &:not(:first-child) {
        margin-left: 5px;
      }

      a {
        display: flex;
        flex-wrap: wrap;
        padding: 4px 0;
        color: $primary + 15%;
        justify-content: center;
        border-radius: 4px 4px 0 0;

        &:hover,
        &.active {
          color: $white;
          background-color: $primary + 15%;
        }
      }

      .fa {
        flex: 100%;
        font-size: 22px;
      }

      span {
        font-size: 13px;
        margin-top: 5px;
      }
    }
  }
</style>
