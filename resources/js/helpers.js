import Resource from "./resource";

export default {
    methods: {
        createResource(url) {
            return new Resource(url);
        }
    }
};
