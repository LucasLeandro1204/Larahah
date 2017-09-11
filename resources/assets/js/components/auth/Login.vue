<template lang="pug">
  section
    .container
      h1 Login
      form.content
        .block
          span.brand
            img(src="images/letter.png")
            | Larahah
        .block
          input(type="email", name="email", placeholder="Email", v-model="form.email")
          p(v-if="form.errors.email", v-text="form.errors.email")
        .block
          input(type="password", name="password", placeholder="Password", v-model="form.password")
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
        route: '/api/login',
        fields: {
          email: '',
          password: '',
        }
      })
    }),
  }
</script>
