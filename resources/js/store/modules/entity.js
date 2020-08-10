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

export default {
    state,
    getters,
    mutations,
    namespaced: true
};
