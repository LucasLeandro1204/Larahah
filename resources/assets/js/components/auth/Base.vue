<script>
  import Auth from '../../services/auth';

  export default {
    store: ['user'],

    methods: {
      post () {
        this.form.post().then(async ({ data: user }) => {
          this.user = await Auth.login(Object.assign({}, user.data, { token: user.token }));
          console.log(this.user);
          this.$router.push({ name: 'home' });
        });
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import "~@/core/variables";

  section {
    .container {
      flex-direction: column;
    }

    .brand {
      color: $primary + 15%;
    }

    form {
      a {
        color: $gray;
      }

      p {
        color: $primary;
        font-size: 12px;
        margin: 5px 0 0 5px;
      }
    }

    @media screen and (max-width: 767px) {
      a {
        font-size: 12px;
      }
    }
  }
</style>
