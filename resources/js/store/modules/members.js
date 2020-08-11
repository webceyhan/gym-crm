import Resource from "../../resource";
import entity from "./entity";

// initialize resource objects
const memberRes = new Resource("/members");

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
    ...entity.actions(memberRes),

    async check({ dispatch }, { id, on }) {
        const status = on ? "inside" : "outside";
        dispatch("save", { id, status });
    }
};

export default {
    state,
    getters,
    mutations,
    actions,
    namespaced: true
};
