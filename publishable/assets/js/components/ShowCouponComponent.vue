<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Show Coupon</div>
                    <div class="card-body">
                        <h5>Coupon Number : <b>{{ coupon.coupon_number }}</b></h5>
                        <h5>Type : {{ coupon.type }}</h5>
                        <h5>Amount :
                            <b v-if="coupon.type == 'PERCENTAGE'">{{ parseFloat(coupon.amount, 2) }} %</b>
                            <b v-else>{{ parseFloat(coupon.amount, 2) }}</b>
                        </h5>
                        <h5>Expire On : {{ coupon.expire_on }}</h5>
                        <h5>Expired : {{ coupon.is_expired }}</h5>
                        <div><u>Coupon Status</u></div>
                        <h5>
                            Applied On Category:
                            {{ coupon.applied_on_cat_count }}
                        </h5>
                        <ul>
                            <li v-for="(cat, index) in coupon.applied_on_cat" :key="index + 'cat'">
                                <div>{{ cat.appliedable && cat.appliedable.name ? cat.appliedable.name : '' }} <button
                                        class="btn badge btn-sm btn-danger"
                                        @click="detachfromCoupon(cat.applied_func.id)">Detach</button></div>

                            </li>
                        </ul>
                        <h5>
                            Applied On Course:
                            {{ coupon.applied_on_course_count }}
                        </h5>
                        <ul>
                            <li v-for="(
                                    course, index
                                ) in coupon.applied_on_course" :key="index + 'course'">
                                <div>{{ course.appliedable && course.appliedable.name ? course.appliedable.name : '' }}
                                <button
                                        class="btn badge btn-sm btn-danger"
                                        @click="detachfromCoupon(course.applied_func.id)">Detach</button>
                                </div>
                            </li>
                        </ul>
                        <hr />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Add Coupon Into Category</h5>
                                        <select class="form-control" v-model="new_category">
                                            <option v-for="(
                                                    category, index
                                                ) in coupon.categories" :key="category.id" :value="category.id">
                                                {{ category.name }}
                                            </option>
                                        </select>
                                        <button class="btn btn-sm btn-success" @click="addCouponIntoCat()">
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Add Coupon Into Course</h5>
                                        <select class="form-control" v-model="new_course">
                                            <option v-for="(
                                                    course, index
                                                ) in coupon.courses" :key="course.id" :value="course.id">
                                                {{ course.name }}
                                            </option>
                                        </select>
                                        <button class="btn btn-sm btn-success" @click="addCouponIntoCourse()">
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            new_category: "",
            new_course: "",
            coupon: [],
        };
    },
    mounted() {
        this.show_coupon();
    },
    methods: {
        detachfromCoupon(id) {
            let headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${localStorage.getItem(
                    "project_access_token"
                )}`,
            };

            this.axios
                .post(
                    `${process.env.MIX_API_END_POINT}/api/detach-coupon/${id}`,
                    {
                    },
                    {
                        headers: headers,
                    }
                )
                .then((response) => {
                    let { data } = response;
                    if (data.status == "ok") {
                        this.show_coupon();
                    }
                    if (data.status == "error") {
                        alert(data.message);
                    }
                });
        },
        addCouponIntoCourse() {
            let headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${localStorage.getItem(
                    "project_access_token"
                )}`,
            };

            this.axios
                .post(
                    `${process.env.MIX_API_END_POINT}/api/applied-coupon/course/${this.new_course}`,
                    {
                        coupon_id: this.$route.params.id,
                    },
                    {
                        headers: headers,
                    }
                )
                .then((response) => {
                    let { data } = response;
                    if (data.status == "ok") {
                        this.show_coupon();
                    }
                    if (data.status == "error") {
                        alert(data.message);
                    }
                });
        },
        addCouponIntoCat() {
            let headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${localStorage.getItem(
                    "project_access_token"
                )}`,
            };

            this.axios
                .post(
                    `${process.env.MIX_API_END_POINT}/api/applied-coupon/category/${this.new_category}`,
                    {
                        coupon_id: this.$route.params.id,
                    },
                    {
                        headers: headers,
                    }
                )
                .then((response) => {
                    let { data } = response;
                    if (data.status == "ok") {
                        this.show_coupon();
                    }
                    if (data.status == "error") {
                        alert(data.message);
                    }
                });
        },
        show_coupon() {
            let headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${localStorage.getItem(
                    "project_access_token"
                )}`,
            };

            this.axios
                .post(
                    `${process.env.MIX_API_END_POINT}/api/coupons/show/${this.$route.params.id}`,
                    {},
                    {
                        headers: headers,
                    }
                )
                .then((response) => {
                    let { data } = response;
                    if (data.status == "ok") {
                        this.coupon = data.data;
                    }
                });
        },
    },
};
</script>
