import type { AxiosInstance } from "axios";

export default class RestUserSession {
    axiosInstance: AxiosInstance;

    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }
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
    
    async checkAuth(access_token: string){
        return this.axiosInstance.get('/api/',{ headers: { Authorization: `Bearer ${access_token}` }}).then(response => response.data);
    }

    async getInfo(): Promise<any> {
        // NOTE: To use this function you must use inject("axios") to setup the Authorization header by default.
        return this.axiosInstance.get('/api/user').then((response) => response.data);
    }

    async updateUserInfo(user: UserEntity): Promise<any> {
        // NOTE: To use this function you must use inject("axios") to setup the Authorization header by default.
        return this.axiosInstance.post('/api/user', user).then((response) => response.data);
    }
};