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
        message(:type="activeTab", :value="key", :key="message.id", v-for="(message, key) in currentTab.data", v-if="currentTab.data.length")
        div(v-else)
          p No messages here =(
</template>

<script>
  import axios from 'axios';
  import Message from './Message.vue';

  export default {
    components: {
      Message,
    },

    store: ['messages'],

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
        return this.messages[this.activeTab];
      },

      currentPage () {
        return this.currentTab.meta.current_page;
      },
    },

    created () {
      if (this.currentTab.data.length <= 0) {
        this.fetch();
      }
    },

    methods: {
      fetch () {
        return axios.get('/api/message/', {
          params: {
            query: this.activeTab,
            page: this.currentPage + 1,
          },
        })
        .then(({ data: message }) => {
          this.currentTab.meta = message.meta;
          this.currentTab.data.push(...message.data);
        });
      }
    },
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
