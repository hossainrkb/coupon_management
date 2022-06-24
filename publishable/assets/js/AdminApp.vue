<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/dashboard" class="nav-item nav-link">Dashboard</router-link>
                    <router-link to="/coupons" class="nav-item nav-link">Coupon</router-link>
                </div>
            </div>
            <button class="btn btn-danger text-right" @click="logouthandle()">Logout</button>
        </nav>
        <router-view> </router-view>
    </div>
</template>
 
<script>
export default {
    methods: {
        logouthandle() {
            let headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${localStorage.getItem(
                    "project_access_token"
                )}`,
            };

            this.axios
                .post(
                    `${process.env.MIX_API_END_POINT}/api/oauth/logout`,
                    {},
                    {
                        headers: headers,
                    }
                )
                .then((response) => {
                    let { data } = response;
                    if (data.status == "ok") {
                        localStorage.removeItem(
                            "project_access_token"
                        )
                        this.$router.push({ name: 'admin-login' })
                    }
                });
        },

    },
}
</script>