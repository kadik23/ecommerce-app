import type { AxiosInstance } from "axios";

export default class RestCarts implements IRestCarts {
    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }
    axiosInstance: AxiosInstance;

    async getAll(access_token:string): Promise<any[]> {
        return this.axiosInstance.get(`/user/cart`, {
            headers: { Authorization: `Bearer ${access_token}` }
        }).then(response => response.data);
    }

    async Create(cart:string,access_token: string): Promise<CartEntity> {
        return this.axiosInstance.post('/user/cart', { cart }, {
            headers: { Authorization: `Bearer ${access_token}` }
        }).then(response => response.data);    
    }

    async Delete(id:string,access_token: string): Promise<any> {
        return this.axiosInstance.delete(`/user/cart/${id}`,{
            headers: { Authorization: `Bearer ${access_token}` }
        }).then(response => response.data);    
    }

    async markItRead(carts: any[],access_token: string): Promise<any> {
        return this.axiosInstance.post('/user/cart/markItRead',
            {carts},
            {
                headers: { Authorization: `Bearer ${access_token}` }
            }
        ).then(response => response.data);    
    }
};
