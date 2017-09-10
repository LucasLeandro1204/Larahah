<template lang="pug">
  section
    .container
      h1 Login
      form
        .block
          span.brand
            img(src="images/letter.png")
            | Larahah
        .block
          input(type="email", name="email", placeholder="Email")
        .block
          input(type="password", name="password", placeholder="Password")
        .block
          button(type="submit") Login
        .block
          router-link(:to="{ name: 'register' }") Doesn't have an account?
            span Join us
</template>

<script>
  import Base from './Base.vue';

  export default {
    extends: Base,
  }
</script>
