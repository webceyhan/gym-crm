import Resource from "../../resource";
import entity from "./entity";

// initialize resource objects
const planRes = new Resource("/plans");

// initial state
const state = () => ({
    ...entity.state
});

// getters
const getters = {
    ...entity.getters
};

// mutations
const mutations = {
    ...entity.mutations
};

// actions
const actions = {
    ...entity.actions(planRes)
};

export default {
    state,
    getters,
    mutations,
    actions,
    namespaced: true
};
