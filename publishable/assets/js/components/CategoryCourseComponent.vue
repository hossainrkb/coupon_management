<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Home</div>
                    <div class="card-body">
                        <h2>Category Courses</h2>
                        <div class="row">
                            <div class="col-md-4" v-for="(course, index) in courses" :key="course.id">
                                <div class="card">
                                    <div :class="[course.has_discount  ? 'card-header bg-success ' : 'card-header']">
                                        <p><b>Course - {{ course.name }}</b></p>
                                    </div>
                                    <div class="card-body">
                                        <img :src="course.img" width="100" />
                                    </div>
                                    <div class="card-footer">
                                        <p><b>Regular Price - {{ course.regular_price }}</b></p>
                                        <p v-if="course.has_discount"><b>Discount Price -  {{ course.after_discount }}</b>
                                        </p>
                                        <p v-if="course.has_discount"> <b>Cut Off - {{ course.cut_off }}</b></p>

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
            courses: [],
            categories: [],
        };
    },
    created() {
        this.axios
            .post(
                `${process.env.MIX_API_END_POINT}/api/category/show/${this.$route.params.id}`,
            )
            .then((response) => {
                // let { data } = response;
                // if (data.status == "ok") {
                //     this.courses = data.data.data;
                // }
            });
    },
};
</script>
