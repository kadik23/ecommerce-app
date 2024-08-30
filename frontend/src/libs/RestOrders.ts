import type { AxiosInstance } from "axios";

export default class RestOrders implements IRestOrders {
    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }
    axiosInstance: AxiosInstance;

    async getAll(access_token:string): Promise<any[]> {
            return this.axiosInstance.get(`/api/user/order`).then(response => response.data);
    }

    async sendOrder(orders: OrderEntity[],access_token:string){
        return this.axiosInstance.post('/api/user/order',{orders}).then((response: any) => response.data);
    }

    async getOrderById(id: string,access_token:string){
        return this.axiosInstance.get(`/api/user/order/${id}`, {
            headers: { Authorization: `Bearer ${access_token}` }
        }).then((response: any) => response.data);
    }
};
