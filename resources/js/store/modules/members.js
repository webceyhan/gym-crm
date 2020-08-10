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
    async load({ commit }, query) {
        commit("clear");

        const members = await memberRes.list(query);
        members.forEach(member => commit("set", member));
    },
    async save({ commit }, data) {
        const member = await memberRes.save(data);
        commit("set", member);
    },
    async delete({ commit }, { id }) {
        await memberRes.delete(id);
        commit("delete", { id });
    },
    async select({ commit, state }, id) {
        // load if not exists yet
        if (!state.entries[id]) {
            const member = await memberRes.get(id);
            commit("set", member); // first add
        }

        commit("select", member);
    },
    async check({ dispatch }, { id, on }) {
        dispatch("save", { id, status: on ? "inside" : "outside" });
    }
};

export default {
    state,
    getters,
    mutations,
    actions,
    namespaced: true
};
