<template lang="pug">
  div
    larahah-header
    main
      router-view
    larahah-footer
</template>

<script>
  import * as LarahahFooter from './Footer.vue';
  import * as LarahahHeader from './Header.vue';

  export default {
    components: {
      LarahahHeader,
      LarahahFooter,
    },
  }
</script>
