import type { AxiosInstance } from "axios";

export default class RestCarts implements IRestCarts {
    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }
    axiosInstance: AxiosInstance;

    async getAll(): Promise<CartEntity[]> {
            return this.axiosInstance.get(`/api/cart`).then(response => response.data);
    }
};
