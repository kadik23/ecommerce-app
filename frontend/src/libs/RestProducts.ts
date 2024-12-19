import type { AxiosInstance } from "axios";

export default class RestProducts implements IRestProducts {
    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }
    axiosInstance: AxiosInstance;

    async getAll(){
            return this.axiosInstance.get(`/`).then(response => response.data);
    }
};
