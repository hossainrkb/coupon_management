import AdminDashboardComponent from './components/AdminDashboardComponent.vue';
import AdminApp from './AdminApp.vue';
import AdminLoginComponent from './components/AdminLoginComponent.vue';
import HomeComponent from './components/HomeComponent.vue';
import CouponListComponent from './components/CouponListComponent.vue';
import AddCouponComponent from './components/AddCouponComponent.vue';
import ShowCouponComponent from './components/ShowCouponComponent.vue';
import UpdateCouponComponent from './components/UpdateCouponComponent.vue';
import CategoryCourseComponent from './components/CategoryCourseComponent.vue';
export const routes = [
    {
        name: 'dashboard',
        path: '/dashboard',
        component: AdminApp,
        children: [
            {
                name: 'dashboard',
                path: '/dashboard',
                component: AdminDashboardComponent,
            },
            {
                name: 'coupons',
                path: '/coupons',
                component: CouponListComponent
            },
            {
                name: 'add-coupons',
                path: '/add-coupon',
                component: AddCouponComponent
            },
            {
                name: 'coupons-show',
                path: '/coupon/show/:id',
                component: ShowCouponComponent
            },
            {
                name: 'coupons-edit',
                path: '/coupon/:id/edit',
                component: UpdateCouponComponent
            },
       
        ]
    },
    {
        name: 'admin-login',
        path: '/admin-login',
        component: AdminLoginComponent
    },
    {
        name: 'home',
        path: '/',
        component: HomeComponent
    },
    {
        name: 'category-course-show',
        path: '/category/show/:id',
        component: CategoryCourseComponent
    },
    {
        path: '*',
        redirect: '/'
      }
];
