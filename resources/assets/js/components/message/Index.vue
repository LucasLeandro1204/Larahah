<template lang="pug">
  section
    .container
      h1 Messages
      article.content
        nav.block
          ul
            li(v-for="(tab, key) in tabs", :key="key")
              a(href="#", :class="{ active: activeTab == key }", @click.prevent="activeTab = key")
                i(:class="['fa', tab.icon]")
                span(v-text="tab.title")
        component(:is="currentTab", :type="activeTab")
</template>

<script>
  import Received from './Received.vue';

  export default {
    components: {
      Received,
    },

    data: () => ({
      activeTab: 'received',
      tabs: {
        received: {
          icon: 'fa-inbox',
          title: 'RECEIVED',
          component: 'received'
        },
        favorited: {
          icon: 'fa-star',
          title: 'FAVORITES',
        },
        sent: {
          icon: 'fa-paper-plane',
          title: 'SENT',
        },
      },
    }),

    computed: {
      currentTab () {
        return this.tabs[this.activeTab].component;
      }
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
