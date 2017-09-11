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
          input(type="text", name="name", placeholder="Name", v-model="form.name")
          p(v-if="form.errors.name", v-text="form.errors.name")
        .block
          input(type="text", name="username", placeholder="Username", v-model="form.username")
          p(v-if="form.errors.username", v-text="form.errors.username")
        .block
          input(type="email", name="email", placeholder="Email", v-model="form.email")
          p(v-if="form.errors.email", v-text="form.errors.email")
        .block
          input(type="password", name="password" placeholder="Password", v-model="form.password")
          p(v-if="form.errors.password", v-text="form.errors.password")
        .block
          input(type="password", name="password_confirmation", placeholder="Password confirmation", v-model="form.password_confirmation")
          p(v-if="form.errors.password_confirmation", v-text="form.errors.password_confirmation")
        .block
          button(type="submit", @click.prevent="post") Register
        .block
          router-link(:to="{ name: 'login' }") Already have an account?
            span Log in
</template>

<script>
  import Base from './Base.vue';
  import Form from '../../core/form';

  export default {
    extends: Base,

    data: () => ({
      form: new Form({
        route: '/api/register',
        fields: {
          name: '',
          email: '',
          password: '',
          username: '',
          password_confirmation: '',
        }
      })
    }),
  }
</script>
