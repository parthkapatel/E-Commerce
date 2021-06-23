import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

//axios.defaults.baseURL = 'http://192.168.0.106:8000/api';
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';
export default new Vuex.Store({
    state: {
        user: null
    },

    mutations: {
        setUserData (state, userData) {
            state.user = userData
            localStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`
        },

        clearUserData () {
            localStorage.removeItem('user')
            location.reload()
        }
    },

    actions: {
        login ({ commit }, credentials) {
            return axios
                .post('/login', credentials)
                .then(({ data }) => {
                    if(data.status !== "" && data.status === "error"){
                        return data;
                    }else{
                        commit('setUserData', data);
                        console.log(this.state.user.user.role);
                        if(this.state.user.user.role === "A"){
                            location.href= "/admin/home";
                        }else if(this.state.user.user.role === "S"){
                            location.href= "/supplier/home";
                        }else if(this.state.user.user.role === "U"){
                            location.href= "/home";
                        }
                    }
                })
        },
        register ({ commit }, credentials) {
            return axios
                .post('/register', credentials)
        },
        logout ({ commit }) {
            commit('clearUserData')
            location.href = "/login";
        }
    },

    getters : {
        isLogged: state => !!state.user,
        userName: state => state.user.user.user_name,
        fullName: state => state.user.user.first_name + " "+ state.user.user.last_name,
        userId: state => state.user.user.customer_id,
        role: state => state.user.user.role,
    }
})
