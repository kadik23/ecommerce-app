import type { AxiosInstance } from "axios";

export default class RestRates implements IRestRates {
    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }
    axiosInstance: AxiosInstance;

    async rateProduct(rate: any){
        return this.axiosInstance.post(`/user/rate`,rate).then(response => response.data);
    }
};
