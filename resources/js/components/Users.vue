<template>
    <div>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in $store.getters.users" :key="index">
                    <td>{{item.first_name}} {{item.last_name}}</td>
                    <td>
                        <p >
                            <span v-for="(role, index) in item.roles" :key="index">
                                {{role.name}},
                            </span>
                        </p>
                    </td>
                    <td>
                        <p >
                            <span v-for="(permission, index) in item.permissions" :key="index">
                                {{permission}},
                            </span>
                        </p>
                        <button class="btn btn-primary btn-sm" type="button">Add permission</button>
                    </td>
                    <td>{{item.created_at}}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" type="button">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    mounted() {
            this.init()

    },
    methods:{
        async init(){
            let url = 'api/v1/users?api_token='+this.$store.getters.api_token
            let {data} = await axios.get(url)
            this.$store.commit('updateUsersList', data.users)
        },
        // renderRolesList(roles){
        //     let names = ''
        //     for(let i in roles){
        //         names = names +", "+ roles[i].name
        //     }
        //     return names
        // }
    },
    computed: {
        
    },
}
</script>
<style lang="">
    
</style>