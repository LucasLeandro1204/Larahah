<template lang="pug">
  section
    .container
      h1 Register
      form
        .block
          span.brand
            img(src="images/letter.png")
            | Larahah
        .block
          input(type="text", name="name", placeholder="Name")
        .block
          input(type="text", name="username", placeholder="Username")
        .block
          input(type="email", name="email", placeholder="Email")
        .block
          input(type="password", name="password" placeholder="Password")
        .block
          input(type="password", name="password_confirmation", placeholder="Password confirmation")
        .block
          button(type="submit") Register
        .block
          router-link(:to="{ name: 'login' }") Already have an account?
            span Log in
</template>

<script>
  import Base from './Base.vue';

  export default {
    extends: Base,
  }
</script>
