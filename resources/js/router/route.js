import Home from "../components/home";
import Dashboard from "../components/admin/dashboard";
import supplierDashboard from "../components/supplier/supplierDashboard";
import createCategory from "../components/admin/category/createCategory";
import viewCategory from "../components/admin/category/viewCategory";
import createProduct from "../components/admin/product/createProduct";
import viewProduct from "../components/admin/product/viewProduct";
import uploadProductImages from "../components/admin/product/uploadProductImages";
import assignCategoriesToProduct from "../components/admin/product/assignCategoriesToProduct";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            role: 'U'
        }
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../components/login.vue'),
    }, {
        path: '/register',
        name: 'register',
        component: () => import('../components/register.vue'),
    },
    {
        path: '/admin/home',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true,
            role: 'A',
        },
    },
    {
        path: '/admin/create-category',
        name: 'createCategory',
        component: createCategory,
        meta: {
            auth: true,
            role: 'A',
        },
    },
    {
        path: '/admin/view-category/',
        name: 'viewCategory',
        component: viewCategory,
        meta: {
            auth: true,
            role: 'A',
        },
    },
    {
        path: '/admin/create-product',
        name: 'createProduct',
        component: createProduct,
        meta: {
            auth: true,
            role: 'A',
        },
    },
    {
        path: '/admin/view-product/',
        name: 'viewProduct',
        component: viewProduct,
        meta: {
            auth: true,
            role: 'A',
        },
    },
    {
        path: '/admin/upload-product-images/',
        name: 'uploadProductImages',
        component: uploadProductImages,
        meta: {
            auth: true,
            role: 'A',
        },
    },
    {
        path: '/admin/assign-categories-to-product/',
        name: 'assignCategoriesToProduct',
        component: assignCategoriesToProduct,
        meta: {
            auth: true,
            role: 'A',
        },
    },
    /*{
        path: '/supplier/home',
        name: 'supplierDashboard',
        component: supplierDashboard,
        meta: {
            auth: true,
            role: 'S',
        },
    },*/
    {
        path: '*',
        component: require('../components/error/E_404').default,
    }
];

export default routes;
