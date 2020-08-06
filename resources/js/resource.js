import Axios from "axios";

export default class Resource {
    constructor(path, parent = "") {
        this.path = path;
        this.shallowPath = `${parent}${path}`;

        // create axios instance
        this.client = Axios.create({ baseURL: "/api" });

        // intercept requests
        this.client.interceptors.request.use(config => {
            this.loading = true; // turn on loading
            return config; // return config
        });

        // intercept responses
        this.client.interceptors.response.use(response => {
            this.loading = false; // turn off loading
            response.data = response.data.data; // unwrap data
            return response; // return response
        });
    }

    async list() {
        const url = this.shallowPath;
        return (await this.client.get(url)).data;
    }

    async get(id) {
        const url = `${this.path}/${id}`;
        return (await this.client.get(url)).data;
    }

    async save(data) {
        const config = {
            method: data.id ? "put" : "post",
            url: data.id ? `${this.path}/${data.id}` : this.shallowPath,
            data
        };

        // workaround: PUT doesn't work with file uploads
        if (data.id && data instanceof FormData) {
            config.method = "post";
            data.append('_method', "put");
        }

        return (await this.client.request(config)).data;
    }

    async delete(id) {
        const url = `${this.path}/${id}`;
        return await this.client.delete(url);
    }
}
