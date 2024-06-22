import type { AxiosInstance } from "axios";

export default class UploadImage implements IUploadImage {
    
    axiosInstance: AxiosInstance;
    constructor(axiosInstance: AxiosInstance) {
        this.axiosInstance = axiosInstance;
    }

    UploadImage = async (file: File): Promise<any> => {
        let formData = new FormData();
        formData.append(`image`, file);
        return await this.axiosInstance.post('/api/auth/upload_images', formData, {
            headers: {
                'Content-Type': 'multipart/form-data', // Important for file uploads
            },
            onUploadProgress: (progressEvent: any) => {
                const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                console.log(percentCompleted);
            }
        }).then(response => response.data);
    }
}