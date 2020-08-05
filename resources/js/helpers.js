import Resource from "./resource";

export default {
    methods: {
        createResource(path, parent) {
            return new Resource(path, parent);
        }
    }
};
