import type { AxiosInstance } from "axios";

export default class RestOrders implements IRestOrders {
    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }
    axiosInstance: AxiosInstance;

    async getAll(): Promise<OrderEntity[]> {
            return this.axiosInstance.get(`/api/order`).then(response => response.data);
    }
};
