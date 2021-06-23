import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import routes from './route'

const router = new VueRouter({
    history: true,
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user')
    const user = JSON.parse(loggedIn);
    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/login')
        return
    } else {
        if (to.matched.some(record => record.meta.auth) && user.user.role === to.matched[0].meta.role && loggedIn){
            console.log("hello");
            if (to.matched[0].path === "" && user.user.role === 'U') {
                next('/')
                return
            } else if ((to.matched[0].path === "") && user.user.role === 'A') {
                next('/admin/home')
                return
            }else if (to.matched[0].path === "" && user.user.role === 'S') {
                next('/supplier/home')
                return
            }
            next()
            return
        } else if(to.matched.some(record => record.meta.auth) && user.user.role !== to.matched[0].meta.role && loggedIn){
            console.log("Else")
            if (user.user.role === 'U') {
                next('/')
                return
            } else if (user.user.role === 'A') {
                next('/admin/home')
                return
            } else if (user.user.role === 'S') {
                next('/supplier/home')
                return
            }
        }
    }
    next()
});

export default router

