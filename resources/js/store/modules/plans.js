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
    async load({ commit }, query) {
        commit("clear");

        const plans = await planRes.list(query);
        plans.forEach(plan => commit("set", plan));
    },
    async save({ commit }, data) {
        const plan = await planRes.save(data);
        commit("set", plan);
        commit("select", plan);
    },
    async delete({ commit }, { id }) {
        await planRes.delete(id);
        commit("delete", { id });
        commit("select", {});
    },
    async select({ commit, state }, { id }) {
        // load if not exists yet
        if (!state.entries[id]) {
            const plan = await planRes.get(id);
            commit("set", plan); // first add
        }

        commit("select", { id });
    }
};

export default {
    state,
    getters,
    mutations,
    actions,
    namespaced: true
};
