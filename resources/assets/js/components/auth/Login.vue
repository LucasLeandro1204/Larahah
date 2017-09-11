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
          p(v-if="form.errors.email", v-text="form.errors.Email")
        .block
          input(type="password", name="password", placeholder="Password")
          p(v-if="form.errors.password", v-text="form.errors.password")
        .block
          button(type="submit", @click.prevent="post") Login
        .block
          router-link(:to="{ name: 'register' }") Doesn't have an account?
            span Join us
</template>

<script>
  import Base from './Base.vue';
  import Form from '../../core/form';

  export default {
    extends: Base,

    data: () => ({
      form: new Form({
        route: '/login',
        fields: {
          name: '',
          email: '',
        }
      })
    }),
  }
</script>
