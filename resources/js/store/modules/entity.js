// initial state
const state = {
    keys: [],
    entries: {},
    selectedId: null
};

// getters
const getters = {
    size: state => {
        state.keys.length;
    },
    get: state => key => {
        return state.entries[key] ? { ...state.entries[key] } : null;
    },
    list: (state, getters) => {
        return state.keys.map(id => getters.get(id));
    },
    selected: (state, getters) => {
        return getters.get(state.selectedId);
    }
};

// mutations
const mutations = {
    set: (state, item) => {
        state.entries = { ...state.entries, [item.id]: item };

        if (!state.keys.includes(item.id)) {
            state.keys.push(item.id);
        }
    },
    delete: (state, { id }) => {
        const entries = { ...state.entries };
        const index = state.keys.findIndex(_id => _id == id);

        delete entries[id];
        state.entries = entries;
        state.keys.splice(index, 1);
    },
    clear: state => {
        state.keys = [];
        state.entries = {};
        state.selectedId = null;
    },
    select: (state, { id }) => {
        state.selectedId = id;
    }
};

// actions
const actions = resource => ({
    async load({ commit }, query) {
        commit("clear");

        const items = await resource.list(query);
        items.forEach(item => commit("set", item));
    },
    async select({ commit, state }, { id }) {
        // load if not exists yet
        if (!state.entries[id]) {
            const item = await resource.get(id);
            commit("set", item); // first add
        }

        commit("select", { id });
    },
    async save({ commit }, data) {
        const item = await resource.save(data);
        commit("set", item);
        commit("select", item);
    },
    async delete({ commit }, { id }) {
        await resource.delete(id);
        commit("delete", { id });
        commit("select", {});
    }
});

export default {
    state,
    getters,
    mutations,
    actions,
    namespaced: true
};
