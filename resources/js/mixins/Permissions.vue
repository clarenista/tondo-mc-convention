<script>
  export default {
    methods: {
      $can(permissionName) {
        return this.$store.getters.permissions.indexOf(permissionName) !== -1;
      },
      $auth(){
        return Permissions;
      },
    },
  };
</script>