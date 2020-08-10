// initial state
const state = {
    keys: [],
    entries: {},
    selectedId: null
};

// getters
const getters = {
    get: state => key => {
        return state.entries[key] ? { ...state.entries[key] } : null;
    },
    list: (state, getters) => {
        return state.keys.map(id => getters.get(id));
    },
    size: state => {
        state.keys.length;
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
    remove: (state, { id }) => {
        const entries = { ...state.entries };
        const index = state.keys.findIndex(_id => _id == id);

        delete entries[id];
        state.entries = entries;
        state.keys.splice(index, 1);
    },
    clear: state => {
        state.selectedId = null;
        state.keys = [];
        state.entries = {};
    },
    select: (state, { id }) => {
        state.selectedId = id;
    }
};

export default {
    state,
    getters,
    mutations,
    namespaced: true
};
