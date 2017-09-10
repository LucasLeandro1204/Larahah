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
          input(type="text", placeholder="Username")
        .block
          input(type="password", placeholder="Password")
        .block
          button(type="submit") Login
        .block
          router-link(:to="{ name: 'register' }") Doesn't have an account?
            span Join us
</template>

<style lang="scss" scoped>
  @import "~@/core/variables";

  section {
    padding: 30px 0;

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .container {
      flex-direction: column;
    }

    .brand {
      color: $primary + 15%;
    }

    form {
      width: 100%;
      margin: 0 auto;
      max-width: 350px;
      border-radius: 4px;
      padding: 30px 30px 15px;
      background-color: $white;
      box-shadow: 0 0 10px 0px $white + -30%;

      a {
        color: $gray;
      }
    }

    @media screen and (max-width: 767px) {
      a {
        font-size: 12px;
      }
    }
  }
</style>
