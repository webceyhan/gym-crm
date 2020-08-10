import Resource from "../../resource";

// initialize resource objects
const memberRes = new Resource("/members");

// initial state
const state = () => ({
    all: {},
    ids: [],
    selectedId: null
});

// getters
const getters = {
    list: (state, getters) => {
        return state.ids.map(id => getters.find(id));
    },
    find: state => id => {
        return state.all[id] ? { ...state.all[id] } : null;
    },
    selected: (state, getters) => {
        return getters.find(state.selectedId);
    }
};

// mutations
const mutations = {
    set: (state, item) => {
        state.all = { ...state.all, [item.id]: item };

        if (!state.ids.includes(item.id)) {
            state.ids.push(item.id);
        }
    },
    remove: (state, { id }) => {
        const all = { ...state.all };
        const index = state.ids.findIndex(_id => _id == id);

        delete all[id];
        state.all = all;
        state.ids.splice(index, 1);
    },
    clear: state => {
        state.selectedId = null;
        state.ids = [];
        state.all = {};
    },
    select: (state, { id }) => {
        state.selectedId = id;
    }
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
        commit("remove", { id });
    },
    async select({ commit, state }, id) {
        // load if not exists yet
        if (!state.all[id]) {
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
