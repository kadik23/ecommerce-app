import type { AxiosInstance } from "axios";

export default class RestInfo {
    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }
    axiosInstance
    async getInfo(){
        return this.axiosInstance.get('/api/info').then((response: any) => response.data);
    }
};
