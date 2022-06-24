<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Coupon List</div>
                    <router-link to="/add-coupon" class="btn btn-success">Add Coupon</router-link>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Expire On</th>
                                    <th>Expired</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(coupon, index) in coupons" :key="coupon.id">
                                    <td>{{ ++index }}</td>
                                    <td>{{ coupon.type }}</td>
                                    <td><b v-if="coupon.type == 'PERCENTAGE'">{{ parseFloat(coupon.amount, 2) }} %</b>
                                        <b v-else>{{ parseFloat(coupon.amount, 2) }}</b>
                                    </td>
                                    <td>{{ coupon.expire_on }}</td>
                                    <td>{{ coupon.is_expired }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <router-link :to="{ name: 'coupons-show', params: { id: coupon.id } }"
                                                class="btn btn-success">Show</router-link>
                                            <router-link :to="{ name: 'coupons-edit', params: { id: coupon.id } }"
                                                class="btn btn-info">Edit</router-link>
                                       
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            coupons: [],
        };
    },
    created() {
        let headers = {
            "Content-Type": "application/json",
            Authorization: `Bearer ${localStorage.getItem(
                "project_access_token"
            )}`,
        };
        this.axios
            .post(
                `/api/coupons`,
                {},
                {
                    headers: headers,
                }
            )
            .then((response) => {
                let { data } = response;
                if (data.status == "ok") {
                    this.coupons = data.data;
                }
            });
    },
};
</script>
