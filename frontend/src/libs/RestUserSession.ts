import type { AxiosInstance } from "axios";

export default class RestUserSession implements IRestUserSession {
    axiosInstance: AxiosInstance;

    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }
    // NOTE: To use this function you must use inject("axios") to setup the Authorization header by default.
    async login(userCredentials: UserCredentials): Promise<any> {
        const { email, password } = userCredentials;
        return this.axiosInstance.post('/api/auth/login', { email, password }).then((response) => response.data);
    }

    async register(user: UserEntity): Promise<any> {
        return this.axiosInstance.post('/api/auth/register', user).then((response) => response.data);
    }

    async logout(): Promise<any> {
        return this.axiosInstance.post('/api/auth/logout').then((response) => response.data);
    }

    async getInfo(): Promise<any> {
        return this.axiosInstance.get('/api/user').then((response) => response.data);
    }

    async updateUserInfo(user: UserEntity): Promise<UserEntity>      {
        return this.axiosInstance.put('/api/auth/user/update', user).then((response) => response.data);
    }

    async getCurrentUser(access_token: string): Promise<UserEntity>{
        return this.axiosInstance.get(`/api/auth/user`,{ headers: { Authorization: `Bearer ${access_token}` }}).then(response => response.data);
}
};