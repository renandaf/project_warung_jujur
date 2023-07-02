import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';
import axios from 'axios';

export default createStore({
    state() {
        return {
            auth: false,
            user: null,
            error: null
        };
    },
    mutations: {
        SET_AUTH(state, auth) {
            state.auth = auth;
        },
        SET_USER(state, user) {
            state.user = user;
        },
        SET_ERROR(state, error) {
            state.error = error;
        },
        CLEAR_ERROR(state) {
            state.error = null;
        },
        CLEAR_AUTH(state) {
            state.auth = false;
        },
        CLEAR_USER(state) {
            state.user = null;
        }
    },
    actions: {
        login({ commit }, { email, password }) {
            return new Promise((resolve, reject) => {
                const data = { email, password };
                axios.post('login', data)
                    .then(() => {
                        commit('SET_AUTH', true);
                        commit('CLEAR_ERROR');
                        resolve();
                    })
                    .catch(error => {
                        commit('SET_ERROR', error.response.data.message);
                        reject(error.response.data.message);
                    });
            });
        },
        getUser({ commit }) {
            return new Promise((resolve, reject) => {
                axios.get('user')
                    .then(response => {
                        const user = response.data;
                        commit('SET_USER', user);
                        resolve();
                    })
                    .catch(error => {
                        commit('SET_ERROR', error.response.data.message);
                        reject(error.response.data.message);
                    });
            });
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                axios.post('logout', null)
                    .then(() => {
                        commit('CLEAR_ERROR');
                        commit('CLEAR_AUTH');
                        commit('CLEAR_USER');
                        resolve();
                    })
                    .catch(error => {
                        commit('SET_ERROR', error.response.data.message);
                        reject(error.response.data.message);
                    });
            });
        },


    },
    getters: {
        isAuthenticated(state) {
            return state.auth;
        },
        getUser(state) {
            return state.user;
        },
        getError(state) {
            return state.error;
        }
    },
    plugins: [createPersistedState()]
});