// initial state
const state = {
    all: {},
    ids: [],
    selectedId: null
};

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

export default {
    state,
    getters,
    mutations,
    namespaced: true
};
