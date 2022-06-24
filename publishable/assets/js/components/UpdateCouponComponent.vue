<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Coupon</div>
                    <div class="card-body">
                        <form @submit.prevent="updateCoupon">
                            <div class="form-group">
                                <label>Type</label>
                                <select v-model="coupon_info.type" class="form-control">
                                    <option value="FIXED AMOUNT">
                                        FIXED AMOUNT
                                    </option>
                                    <option value="PERCENTAGE">
                                        PERCENTAGE
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" step="0.0001" class="form-control" v-model="coupon_info.amount" />
                            </div>
                            <div class="form-group">
                                <label>Expire On</label>
                                <input type="date" class="form-control" v-model="coupon_info.expire_on" />
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </form>
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
            coupon_info: {
                type: "FIXED AMOUNT",
                amount: "",
                expire_on: "",
            },
        };
    },
    mounted() {
        this.edit_coupon();
    },
    methods: {
        edit_coupon() {
            let headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${localStorage.getItem(
                    "project_access_token"
                )}`,
            };

            this.axios
                .post(
                    `/api/coupons/${this.$route.params.id}/edit`,
                    {},
                    {
                        headers: headers,
                    }
                )
                .then((response) => {
                    let { data } = response;
                    if (data.status == "ok") {
                        console.log(data);
                        let coupon = data.data;
                        this.coupon_info = {
                            type: coupon.type,
                            amount: coupon.amount,
                            expire_on: coupon.coupon_expire_on
                        };
                    }
                });
        },
        updateCoupon() {
            let headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${localStorage.getItem(
                    "project_access_token"
                )}`,
            };
            let { type, amount, expire_on } = this.coupon_info;
            let data = {
                type: type,
                amount: amount,
                expire_on: expire_on,
            };
            this.axios
                .put(
                    `/api/coupons/${this.$route.params.id}/update`,
                    data,
                    { headers }
                )
                .then((response) => {
                    let { data } = response;
                    if (data.status == "ok") {
                        this.$router.push({ name: "coupons" });
                    }
                })
                .catch((err) => console.log(err))
                .finally(() => (this.loading = false));
        },
    },
};
</script>
