import type { AxiosInstance } from "axios";

export default class RestUserSession {
    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }
    axiosInstance
    async login(userCredentials){
        let { email, password } = userCredentials;
        return this.axiosInstance.post('/api/auth/login',{ email, password }).then((response: any) => response.data);
    }

    async register(user){
        return this.axiosInstance.post('/api/auth/register', user).then((response: any) => response.data);
    }

    async logout(){
        return this.axiosInstance.post('/api/auth/logout').then((response: any) => response.data);
    }

    async checkAuth(access_token){
        return this.axiosInstance.get('/api/auth/me',{ headers: { Authorization: `Bearer ${access_token}` }}).then(response => response.data);
    }

    async getInfo(){
        // NOTE: To use this function you must use inject("axios") to setup the Authorization header by default.
        return this.axiosInstance.get('/api/user').then((response: any) => response.data);
    }

    async updateUserInfo(user){
        // NOTE: To use this function you must use inject("axios") to setup the Authorization header by default.
        return this.axiosInstance.post('/api/user', user).then((response: any) => response.data);
    }
};
