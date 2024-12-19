import type { AxiosInstance } from "axios";

export default class RestProducts implements IRestProducts {
    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }
    axiosInstance: AxiosInstance;

    async getAll(){
            return this.axiosInstance.get(`/api/`).then(response => response.data);
    }
};
