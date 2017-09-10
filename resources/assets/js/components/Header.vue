<template lang="pug">
  header
    nav
      .container
        router-link(:to="{ path: '/' }", active-class="", exact-active-class="").brand
          img(src="images/letter.png")
          | Larahah
        a.close(@click.prevent="toggle()")
          i.fa.fa-bars
        ul(:class="{ open }")
          li(@click="toggle(true)")
            router-link(:to="{ name: 'home' }" exact) Home
          template(v-if="!user.name")
            li(@click="toggle(true)")
              router-link(:to="{ name: 'register' }") Register
            li(@click="toggle(true)")
              router-link(:to="{ name: 'login' }") Login
</template>

<script>
  export default {
    store: ['user'],

    data: () => ({
      open: false,
    }),

    methods: {
      toggle (flag = false) {
        this.open = ! this.open && ! flag;
      }
    }
  }
</script>

<style lang="scss">
  @import "~@/core/variables";

  header nav {
    background-color: $primary;

    .brand {
      padding: 0;
      font-size: 22px;
      font-weight: 700;
      font-family: 'Cairo', sans-serif;
    }

    ul,
    .close {
      margin-left: auto;
    }

    .close {
      display: none;
    }

    ul {
      display: flex;
      background-color: $primary;
    }

    li:not(:first-of-type) {
      margin-left: 15px;
    }

    a {
      color: $white;
      display: flex;
      padding: 15px;
      align-items: center;

      &:hover,
      &.active {
        background-color: $primary + 15%;
      }
    }

    @media screen and (max-width: 767px) {
      .close {
        display: inherit;
      }

      ul {
        top: 46px;
        left: -100vw;
        width: 100vw;
        position: fixed;
        transition: 300ms;
        flex-direction: column;
        height: calc(100vh - 46px);

        li {
          margin: 0 !important;
        }

        &.open {
          left: 0;
        }
      }
    }
  }
</style>
